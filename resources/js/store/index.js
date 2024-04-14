import { createStore } from 'vuex';
import createPersistedState from 'vuex-persistedstate';

export const store = createStore({
	strict: process.env.NODE_ENV !== 'production',
	plugins: [createPersistedState()],

	state: {
		cart: [],
		contact: {
			ready: false,
			firstName: '',
			lastName: '',
			email: '',
			phone: '',
		},
		shippingAddress: {
			ready: false,
			address: '',
			references: '',
			postalCode: '',
			country: '',
			city: '',
		},
		shippingOption: {
			ready: false,
			id: null,
			name: '',
			tracking_link: '',
			description: '',
			fee: '',
		},
		payment: {
			ready: false,
			method: '',
			cardHoldersName: '',
			cardlastFour: '',
			cardType: '',
			paypalAccount: '',
			stripeToken: '',
		},
		billingAddress: {
			ready: false,
			sameAsShipping: true,
			firstName: '',
			lastName: '',
			email: '',
			phone: '',
			address: '',
			postalCode: '',
			country: '',
			city: '',
		},
		wishlistItems: [],
	},
	getters: {
		cart: (state) => {
			return state.cart;
		},
		productsInCart: (state) => {
			return _.sumBy(state.cart, 'quantity');
		},
		cartTotal: (state) => {
			return _.sumBy(state.cart, (product) => {
				let discount = 0;

				if (product.has_discount) {
					if (!_.isEmpty(product.variant)) {
						discount = product.variant.price * (product.discount_rate / 100);
					} else {
						discount = product.price * (product.discount_rate / 100);
					}
				}

				if (!_.isEmpty(product.variant)) {
					return (product.variant.price - discount) * product.quantity;
				}

				return (product.price - discount) * product.quantity;
			});
		},
		customerHasCoupon: (state) => {
			return !_.isEmpty(state.coupon);
		},
		// Detecta si se ha aplicado un cupon ydetermina el descuento a mostrar
		discountThroughCoupon: (state, getters) => {
			if (!getters.customerHasCoupon) {
				return 0;
			}

			switch (state.coupon.kind) {
				case 'free_shipping':
					return _.get(state.shippingInfo, 'shipping.fee', 0);
					break;
				case 'discount':
					return getters.cartTotal * (state.coupon.discount_percent / 100);
					break;
			}
		},
		contact: (state) => {
			return state.contact;
		},
		contactPreview: (state) => {
			let { firstName, lastName, email, phone } = state.contact;
			let previewString = [`${firstName} ${lastName}`, email, phone].join();

			return (previewString.length > 40 ? previewString.substr(0, 39) : previewString) + '...';
		},
		shippingAddress: (state) => {
			return state.shippingAddress;
		},
		shippingAddressPreview: (state) => {
			let { address, references, postalCode, country, city } = state.shippingAddress;
			let previewString = [address, references, postalCode, country, city].join();

			return (previewString.length > 40 ? previewString.substr(0, 39) : previewString) + '...';
		},
		shippingOption: (state) => {
			return state.shippingOption;
		},
		shippingOptionPreview: (state) => {
			return `${state.shippingOption.name}, ${state.shippingOption.description}...`;
		},
		payment: (state) => {
			return state.payment;
		},
		paymentPreview: (state) => {
			return state.payment.method === 'card' ? `${state.payment.cardType} - ${state.payment.cardlastFour}` : 'PayPal';
		},
		billingAddress: (state) => {
			return state.billingAddress;
		},
		billingAddressPreview: (state) => {
			if (state.billingAddress.sameAsShipping) {
				return 'SAME AS SHIPPING ADDRESS';
			} else {
				let { firstName, lastName, email, phone, address, postalCode, country, city } = state.billingAddress;
				let previewString = [firstName, lastName, email, phone, address, postalCode, country, city].join();

				return (previewString.length > 40 ? previewString.substr(0, 39) : previewString) + '...';
			}
		},
		coupon: (state) => {
			return state.coupon;
		},
		activeStep: (state) => {
			if (state.billingAddress.ready && state.payment.ready && state.shippingOption.ready && state.shippingAddress.ready && state.contact.ready) {
				return 6;
			}

			if (state.payment.ready && state.shippingOption.ready && state.shippingAddress.ready && state.contact.ready) {
				return 5;
			}

			if (state.shippingOption.ready && state.shippingAddress.ready && state.contact.ready) {
				return 4;
			}

			if (state.shippingAddress.ready && state.contact.ready) {
				return 3;
			}

			if (state.contact.ready) {
				return 2;
			}

			return 1;
		},
	},

	mutations: {
		changeCart(state, { action, product }) {
			switch (action) {
				case 'reset':
					state.cart = [];
					break;
				default:
					state.cart.push(product);
					break;
			}
		},
		changeCartAt(state, { action, pos, value }) {
			switch (action) {
				case 'quantity':
					state.cart[pos].quantity = value;
					break;
				case 'drop':
					state.cart.splice(pos, 1);
			}
		},
		changeOrder(state, { action, order }) {
			switch (action) {
				case 'coupon':
					state.coupon = order;
					break;

				default:
					_.each(state[action], (info, key) => {
						if (order.hasOwnProperty(key)) {
							state[action][key] = order[key];
						}
					});
					break;
			}
		},
	},

	actions: {
		addToStoredCart({ commit, state, dispatch }, product) {
			let index = _.findIndex(state.cart, ['id', product.id]);

			// Existe el producto pero no tiene tags ni notas
			if (index > -1 && _.isEmpty(product.tags) && product.notes.length < 1) {
				// Notiene variante
				if (_.isUndefined(product.variant)) {
					commit('changeCartAt', {
						action: 'quantity',
						pos: index,
						value: state.cart[index].quantity + product.quantity,
					});

					return false;
				}

				// Buscar en variantes
				var productwithVariantIndex = -1;

				_.each(state.cart, (prod, pos) => {
					if (!_.isUndefined(prod.variant) && prod.variant.id === product.variant.id) {
						productwithVariantIndex = pos;
					}
				});

				if (productwithVariantIndex > -1) {
					commit('changeCartAt', {
						action: 'quantity',
						pos: productwithVariantIndex,
						value: state.cart[productwithVariantIndex].quantity + product.quantity,
					});
					return false;
				}
			}

			commit('changeCart', {
				action: 'add',
				product: product,
			});
		},
		emptyStoredCart({ commit }) {
			commit('changeCart', {
				action: 'replace',
				product: [],
			});
		},
		oneMoreQuantity({ state, commit }, { pos }) {
			let product = state.cart[pos];

			commit('changeCartAt', {
				action: 'quantity',
				pos: pos,
				value: product.quantity + 1,
			});
		},
		oneLessQuantity({ state, commit, dispatch }, { pos }) {
			let product = state.cart[pos];

			if (product.quantity > 1) {
				commit('changeCartAt', {
					action: 'quantity',
					pos: pos,
					value: product.quantity - 1,
				});
			} else {
				dispatch('dropFromStoredCart', { pos: pos });
			}
		},
		dropFromStoredCart({ commit }, { pos }) {
			commit('changeCartAt', {
				action: 'drop',
				pos: pos,
			});
		},
		confirmContact({ commit }, contact) {
			commit('changeOrder', {
				action: 'contact',
				order: { ...contact, ...{ ready: true } },
			});
		},
		confirmShippingAddress({ commit }, shippingAddress) {
			commit('changeOrder', {
				action: 'shippingAddress',
				order: { ...shippingAddress, ...{ ready: true } },
			});
		},
		confirmshippingOption({ commit }, shippingOption) {
			commit('changeOrder', {
				action: 'shippingOption',
				order: { ...shippingOption, ...{ ready: true } },
			});
		},
		confirmPayment({ commit }, payment) {
			commit('changeOrder', {
				action: 'payment',
				order: { ...payment, ...{ ready: true } },
			});
		},
		confirmBillingAddress({ commit }, billingAddress) {
			commit('changeOrder', {
				action: 'billingAddress',
				order: { ...billingAddress, ...{ ready: true } },
			});
		},
		stepBack({ commit, getters }, step) {
			var actions = [];

			switch (step) {
				case 1:
					actions = ['contact', 'shippingAddress', 'shippingOption', 'payment', 'billingAddress'];

					break;
				case 2:
					if (getters.activeStep > 1) {
						actions = ['shippingAddress', 'shippingOption', 'payment', 'billingAddress'];
					}

					break;
				case 3:
					if (getters.activeStep > 2) {
						actions = ['shippingOption', 'payment', 'billingAddress'];
					}

					break;
				case 4:
					if (getters.activeStep > 3) {
						actions = ['payment', 'billingAddress'];
					}

					break;
				case 5:
					if (getters.activeStep > 4) {
						actions = ['billingAddress'];
					}

					break;
			}

			_.each(actions, (action) => {
				commit('changeOrder', {
					action: action,
					order: {
						ready: false,
					},
				});
			});
		},
		resetContact({ commit }) {
			commit('changeOrder', {
				action: 'shippingOption',
				order: {
					ready: false,
					firstName: '',
					lastName: '',
					email: '',
					phone: '',
				},
			});
		},
		resetShippingAddress({ commit }) {
			commit('changeOrder', {
				action: 'shippingOption',
				order: {
					ready: false,
					address: '',
					references: '',
					postalCode: '',
					country: '',
					city: '',
				},
			});
		},
		resetShippingOption({ commit }) {
			commit('changeOrder', {
				action: 'shippingOption',
				order: {
					ready: false,
					id: null,
					name: '',
					tracking_link: '',
					description: '',
					fee: '',
				},
			});
		},
		resetPayment({ commit }) {
			commit('changeOrder', {
				action: 'payment',
				order: {
					ready: false,
					method: '',
					cardHoldersName: '',
					cardlastFour: '',
					cardType: '',
					paypalAccount: '',
					stripeToken: '',
				},
			});
		},
		resetBillingAddress({ commit }) {
			commit('changeOrder', {
				action: 'billingAddress',
				order: {
					ready: false,
					sameAsShipping: true,
					firstName: '',
					lastName: '',
					email: '',
					phone: '',
					address: '',
					postalCode: '',
					country: '',
					city: '',
				},
			});
		},
		resetCart({ commit }) {
			commit('changeCart', {
				action: 'reset',
			});
		},
		setCoupon({ commit }, coupon) {
			commit('changeOrder', {
				action: 'coupon',
				order: coupon,
			});
		},
		removeCoupon({ commit }) {
			commit('changeOrder', {
				action: 'coupon',
				order: {},
			});
		},
	},
});
