$(document).ready(function() {
    $('#registerForm').bootstrapValidator({
//        live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            pseudo: {
                validators: {
                    notEmpty: {
                        message: 'Le pseudo ne peux pas être vide'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'Le pseudo doit faire plus de 6 et moins de 30 caractères'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'Le pseudo doit contenir uniquement des chiffres, lettres, points et underscores'
                    }
                }
            },
            email: {
                validators: {
                    emailAddress: {
                        message: 'Ce n\'est pas une adresse email valide'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Le mot de passe ne peux pas être vide'
                    },
                    identical: {
                        field: 'password2',
                        message: 'Les deux mots de passe ne sont pas identiques'
                    }
                }
            },
            password2: {
                validators: {
                    notEmpty: {
                        message: 'La confirmation du mot de passe ne peut pas être vide'
                    },
                    identical: {
                        field: 'password',
                        message: 'Le mot de passe et sa confirmation ne sont pas identique'
                    }
                }
            }
        }
    });
});