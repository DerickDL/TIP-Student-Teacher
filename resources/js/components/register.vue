<template>
    <section class="hero is-fullheight is-medium">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="columns is-centered is-mobile">
                    <div class="column is-two-fifths-desktop is-three-fifths-tablet is-full-mobile">
                        <div class="login-container">
                            <figure class="logo">
                                <img src="/img/TIP-logo.png">
                            </figure>
                            <b-field>
                                <b-input placeholder="First Name"
                                         icon="account">
                                </b-input>
                            </b-field>
                            <b-field>
                                <b-input placeholder="Last Name"
                                         icon="lock">
                                </b-input>
                            </b-field>
                            <b-field>
                                <b-input placeholder="Email ID"
                                         icon="lock">
                                </b-input>
                            </b-field>
                            <b-field>
                                <b-input placeholder="Username"
                                         icon="lock">
                                </b-input>
                            </b-field>
                             <b-field>
                                <b-input placeholder="Password"
                                         type="password"
                                         icon="lock"
                                         password-reveal>
                                </b-input>
                            </b-field>
                            <a class="button is-secondary is-fullwidth">Register</a>
                        </div>
                    </div>
                </div>
                <div class="columns is-full is-mobile is-centered">
                    <p>
                        Already have account? Login here.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>