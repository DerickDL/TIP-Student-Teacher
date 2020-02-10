<template>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="columns is-centered is-mobile">
                    <div class="column is-two-fifths-desktop is-three-fifths-tablet is-full-mobile">
				        <div class="login-container">
						<figure class="logo">
							<img src="/img/TIP-logo.png">
						</figure>
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
                aLogin: {
                	sUsername: '',
                	sPassword: '',
                    iType: 1
                }
            }
        },
        methods: {
           doLogin() {
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
						window.location.href = '/teacher/sections';
                	}
           		})
           		.catch(err => console.log(err));
			}
        }
    }
</script>