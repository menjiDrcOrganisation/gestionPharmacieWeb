<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Bienvenue - Changement de mot de passe</title>
</head>

<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f5f9f5; color:#333;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f5f9f5; padding:30px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.1); border: 1px solid #e0eae0;">

                    <!-- Logo -->
                    <tr>
                        <td style="padding:20px; text-align:center; background-color:#ffffff;">
                            <img src="https://Opharma.site/assets/img/logo-ct.png" alt="Opharma"
                                style="border-radius: 50%; max-width:150px; height:auto;">
                        </td>
                    </tr>

                    <!-- Header -->
                    <tr>
                        <td
                            style="background-color:#2e7d32; padding:20px; text-align:center; color:#ffffff; font-size:22px; font-weight:bold;">
                            🛒 Bienvenue vendeur !
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:30px; color:#333; font-size:16px; line-height:1.6;">
                            <p>Cher(e) <strong>{{ $user->name }}</strong>,</p>

                            <p>Votre compte vendeur a été créé avec succès sur notre plateforme. Pour finaliser votre
                                inscription et sécuriser votre accès, vous devez définir votre mot de passe.</p>

                            <p>Pour des raisons de sécurité, nous vous demandons de créer un mot de passe robuste
                                contenant au moins :</p>
                            <ul>
                                <li>8 caractères minimum</li>
                                <li>Une lettre majuscule</li>
                                <li>Un chiffre</li>
                                <li>Un caractère spécial</li>
                            </ul>

                            <div style="text-align:center; margin-top:30px;">
                                <a href="{{ $resetUrl }}"
                                    style="display:inline-block; background-color:#4caf50; color:#ffffff; padding:12px 24px; border-radius:6px; text-decoration:none; font-weight:bold; border: 1px solid #3d8b40;">
                                    🔑 Créer votre mot de passe
                                </a>
                            </div>

                            <p style="margin-top:20px; color:#d32f2f; font-weight:bold;">⚠️ Ce lien est valable pendant
                                60 minutes pour des raisons de sécurité.</p>

                            <p style="margin-top:20px;">Si vous n'avez pas initié cette demande, veuillez ignorer cet
                                email ou contacter notre support.</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="background-color:#2e7d32; padding:15px; text-align:center; color:#e8f5e9; font-size:14px;">
                            &copy; {{ date('Y') }} Opharma. Tous droits réservés.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
