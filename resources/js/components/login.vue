<template>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="columns is-centered is-mobile">
                    <div class="column is-two-fifths-desktop is-three-fifths-tablet is-full-mobile">
                    	<div class="tabs is-toggle is-fullwidth">
						  <ul>
						    <li v-bind:class="{ 'is-active': isLogin }" v-on:click="toggleMode(sLogin)">
						      <a>
						        <span class="has-text-white">Login</span>
						      </a>
						    </li>
						    <li v-bind:class="{ 'is-active': isRegister }" v-on:click="toggleMode(sRegister)">
						      <a>
						        <span class="has-text-white">Register</span>
						      </a>
						    </li>
						  </ul>
						</div>
				        <div class="login-container">
	                            <figure class="logo">
	                                <img src="/img/TIP-logo.png">
	                            </figure>
	                            <div v-if="isLogin">
									<div class="field" v-if="user_type === 'student'">
										<div class="control has-icons-left">
											<input class="input" type="text" placeholder="Student ID" v-model="aLogin.sStudent" v-on:keyup.enter="doLogin">
											<span class="icon is-left">
										      <i class="mdi mdi-contact-mail"></i>
										    </span>
										</div>
									</div>
	                            	<div class="field">
	                            		<div class="control has-icons-left has-icons-right">
	                            			<input class="input" type="text" placeholder="Username" v-model="aLogin.sUsername" v-on:keyup.enter="doLogin">
			                                <span class="icon is-left">
										      <i class="mdi mdi-account"></i>
										    </span>
	                            		</div>
		                            </div>
		                            <div class="field">
		                                <div class="control has-icons-left has-icons-right">
	                            			<input class="input" type="password" placeholder="Password" v-model="aLogin.sPassword" v-on:keyup.enter="doLogin">
			                                <span class="icon is-left">
										      <i class="mdi mdi-lock"></i>
										    </span>
	                            		</div>
		                            </div>
		                            <a class="button is-secondary is-fullwidth has-text-white" v-on:click="doLogin">Login</a>
	                            </div>
	                            <div v-else>
	                            	<div class="field">
		                               <div class="control">
	                            			<input class="input" type="text" placeholder="First Name" v-model="aRegister.sFirstName" v-on:keyup.enter="doRegister">
	                            		</div>
		                            </div>
		                            <div class="field">
		                                 <div class="control">
	                            			<input class="input" type="text" placeholder="Last Name" v-model="aRegister.sLastName" v-on:keyup.enter="doRegister">
	                            		</div>
		                            </div>
		                            <div class="field">
		                                <div class="control">
	                            			<input class="input" type="text" placeholder="Email ID" v-model="aRegister.sEmail" v-on:keyup.enter="doRegister">
	                            		</div>
		                            </div>
									<div class="field" v-if="register_user_type === 'student'">
										<div class="control">
											<input class="input" type="text" placeholder="Student ID" v-model="aRegister.sStudent" v-on:keyup.enter="doRegister">
										</div>
									</div>
		                            <div class="field">
		                                <div class="control">
	                            			<input class="input" type="text" placeholder="Username" v-model="aRegister.sUsername" v-on:keyup.enter="doRegister">
	                            		</div>
		                            </div>
		                            <div class="field">
		                                <input class="input" type="password" placeholder="Password" v-model="aRegister.sPassword" v-on:keyup.enter="doRegister">
		                            </div>
		                            
	                            	<a class="button is-secondary is-fullwidth has-text-white" v-on:click="doRegister">Register</a>
	                            </div>
	                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
    export default {
        data() {
            return {
                isLogin: true,
                isRegister: false,
                sLogin: 'login',
                sRegister: 'register',
                user_type: 'student',
                register_user_type: 'student',
                aRegister: {
                	sFirstName: '',
                	sLastName: '',
                	sEmail: '',
                	sStudent: '',
                	sUsername: '',
                	sPassword: '',
                	iType: ''
                },
                aLogin: {
                    sStudent: '',
                	sUsername: '',
                	sPassword: '',
                    iType: ''
                }
            }
        },
        methods: {
           toggleMode(sMode) {
           		if (sMode === this.sLogin) {
           			this.isLogin = true;
           			this.isRegister = false;
           		} else {
           			this.isLogin = false;
           			this.isRegister = true;
           		}
           },
           doLogin() {
               this.aLogin.iType = (this.user_type === 'teacher') ? 1 : 0;
               this.aLogin.sStudent = (this.user_type === 'teacher') ? '' : this.aLogin.sStudent;
           		fetch('/login', {
           			method: 'post',
           			body: JSON.stringify(this.aLogin),
                    headers: {
                        'content-type': 'application/json'
                    }
           		})
           		.then(res => res.json())
           		.then(data => {
           			if (data.result === false) {
                		alert(data.message);
                	} else {
                		alert('Successfully Login');
                		if (data.data['user_type'] === 0) {
                			//redirect to student home page
                      		window.location.href = '/classes';
                		} else {
                			//redirect to teacher home page
                      		window.location.href = '/teacher';
                		}
                	}
           		})
           		.catch(err => console.log(err));
           },
           doRegister() {
           		this.aRegister.iType = (this.register_user_type === 'teacher') ? 1 : 0;
               	this.aRegister.sStudent = (this.register_user_type === 'teacher') ? '' : this.aRegister.sStudent;
           		fetch('/register', {
                    method: 'post',
                    body: JSON.stringify(this.aRegister),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                	if (data.result === false) {
                		alert(data.message);
                	} else {
						this.isLogin = true;
						this.isRegister = false;
						this.aRegister.sFirstName = '';
						this.aRegister.sLastName = '';
						this.aRegister.sEmail = '';
						this.aRegister.sUsername = '';
						this.aRegister.sPassword = '';
						this.aRegister.iType = '';
						this.aRegister.sStudent = '';
                		alert('Successfully Registered');
                	}
                })
                .catch(err => console.log(err));
           },

        }
    }
</script>