<template>


	<div id="contacto">
	

		<div id="formulario" :class="resultClass">
			
			<div class="seccion">
				<h6>Tipo de evento</h6>
				<div class="group triple">
					<div class="input">
						<div class="selector">
							<select>
								<option selected disabled>Selecciona tu tipo de evento</option>
								<option></option>
							</select>
							<div class="arrow">
								<i class="fa fa-caret-down" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="seccion">
				<h6>Datos del contacto</h6>
				<div class="group triple">
					<div class="input" :class="{alerta:alerts[0]}">
						<input type="text" placeholder="Nombre(s)" v-model="name" @keypress="removeAlerts"/>
					</div>
					
					<div class="input">
						<input type="text" placeholder="Apellido Paterno" v-model="name_p" @keypress="removeAlerts"/>
					</div>
					
					<div class="input">
						<input type="text" placeholder="Apellido Materno" v-model="name_m" @keypress="removeAlerts"/>
					</div>
				</div>
				<div class="group triple">
					<div class="input" :class="{alerta:alerts[1]}">
						<input type="text" placeholder="Correo electrónico" v-model="email" @keypress="removeAlerts"/>
					</div>
					<div class="input" :class="{alerta:alerts[2]}">
						<input type="text" placeholder="Teléfono celular a 10 dígitos" v-model="phone" @keypress="removeAlerts"/>
					</div>
					<div class="input"></div>
				</div>
			</div>
			
			
			<div class="seccion">
				<h6>Dirección del evento</h6>
				<div class="group triple">
					<div class="input">
						<input type="text" placeholder="Nombre(s)" v-model="name" @keypress="removeAlerts"/>
					</div>
					
					<div class="input">
						<div class="group doble">
							<div class="input">
								<input type="text" placeholder="Nombre(s)" v-model="name" @keypress="removeAlerts"/>
							</div>
							<div class="input">
								<input type="text" placeholder="Nombre(s)" v-model="name" @keypress="removeAlerts"/>
							</div>
						</div>
					</div>
					
					<div class="input">
						<input type="text" placeholder="Apellido Materno" v-model="name_m" @keypress="removeAlerts"/>
					</div>
				</div>
				<div class="group triple">
					<div class="input">
						<input type="text" placeholder="Colonia" v-model="colonia" @keypress="removeAlerts"/>
					</div>
					<div class="input">
						<input type="text" placeholder="Municipio" v-model="municipio" @keypress="removeAlerts"/>
					</div>
					<div class="input">
						<div class="selector">
							<select v-model="estado">
								<option selected disabled>Estado</option>
								<option></option>
							</select>
							<div class="arrow">
								<i class="fa fa-caret-down" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div id="actions">
				<button class="boton" @click="send" style="pointer-events: none; opacity: .5;"><span>{{ notification }}</span></button>
			</div>
			
			<div id="legal">
				<small>Información protegida por encriptación SSL.</small>
			</div>
	
		</div>
		
		
		<div id="msg" v-if="false">
			<div class="centro">
				<span>Tu solicitud se envió con éxito.<br>Nuestro equipo se comunicará contigo para continuar con el proceso.</span>
				<a href="/"><button class="boton"><span>Volver al inicio</span></button></a>
			</div>
		</div>
		
	</div>

	
</template>

<script>
	
	import useVuelidate from '@vuelidate/core';
	import { required } from '@vuelidate/validators';
	
	export default {
		setup() {
			return { v$: useVuelidate({ $autoDirty: true }) };
		},
		data() {
			return {
				name: '',
				email: '',
				phone: '',
				message: '',
				notification: 'Enviar',
				alerts:[false,false,false,false],
				resultClass: '',
				errors:[],
				showErrors: false,
			};
		},
		validations() {
			
			return {
				name: {
					required,
				},
				email: {
					required,
				},
				phone: {
					required,
				},
				message: {
					required,
				},
			}
		},
		methods: {
			
			
			validate() {
				this.errors = [];

				if (this.v$.name.required.$invalid) {
					this.errors.push('Escribe tu nombre');
					this.alerts[0] = true;
				}

				if (this.v$.email.required.$invalid) {
					this.errors.push('Escribe tu email');
					this.alerts[1] = true;
				}

				if (this.v$.phone.required.$invalid) {
					this.errors.push('Escribe tu telefono');
					this.alerts[2] = true;
				}

				if (this.v$.message.required.$invalid) {
					this.errors.push('Escribe tu mensaje');
					this.alerts[3] = true;
				}

				if (_.isEmpty(this.errors)) {
					this.showErrors = false;
					
					return true;
					
				} else {
					this.showErrors = true;
					
					return false;
				}
			},

			initForm() {
				this.name =  '';
				this.email = '';
				this.phone = '';
				this.message = '';
			},
			
			removeAlerts(){
				this.errors = [];
				this.showErrors = false;
				this.alerts = [false,false,false,false];
			},
			
			async send() {
				if (this.validate()) {
					this.bad('error');
					return false;
				}

				this.loading('Enviando...');

				let contacto = {
					site_id: '',
					token: '',
					data: {
						Name: this.name,
						Email: this.email,
						Phone: this.phone,
						Message: this.message,
					},
				};


				let response = await window.axios.post('https://mail.planetoi.de/api/send', contacto);

				if (response.status) {
					this.removeAlerts();
					this.initForm();
					this.good('Enviado');
				} else {
					this.bad('Error');
					this.removeAlerts();
				}

			},

			good(msg) {
				this.notification = msg;
				this.resultClass = 'ok';
			},

			bad(msg) {
				this.notification = msg;
				this.resultClass = 'error';

				setTimeout(() => {
					this.resultClass = '';
				}, 4000);
			},

			loading(msg) {
				this.notification = msg;
				this.resultClass = 'waiting';
			},
		},
	};
</script>


