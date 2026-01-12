<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Document de Recueil des Exigences et des Besoins</title>
    <style>
        @page { margin: 80px 50px 100px 50px; }
        body { font-family: Arial, sans-serif; font-size: 9px; line-height: 1.3; }
        .header-box { padding: 8px; margin-bottom: 15px; text-align: center; font-size: 8px; line-height: 1.4;margin-top:-80px; }
        .title { font-size: 20px; font-weight: bold; text-align: center; margin: 15px 0;border-bottom: 2px solid #000; padding-bottom: 5px; }
        .section { margin-bottom: 12px; }
        .section-title { font-weight: bold; background-color: #e0e0e0; padding: 5px; margin-bottom: 10px; }
        footer { position: fixed; bottom: -80px; left: 0; right: 0; text-align: center; font-size: 7px; line-height: 1.3; }

        .field { margin-bottom: 8px; }
        .field-label { font-weight: bold; display: inline-block; width: 200px; }
        .field-value { display: inline-block; border-bottom: 1px solid #000; min-width: 300px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 5px; vertical-align: top; }

    </style>
</head>
<body>
    <div class="header-box">
        <img src="{{ asset('img/logo.png')}}" width="80" />
    </div>
    <div class="title">
        DOCUMENT DE RECUEIL DES EXIGENCES ET DES BESOINS
    </div>

    <p style="margin-bottom: 15px;">
        Dans le cadre de son activité réglementée, votre courtier / intermédiaire doit recueillir un certain 
        nombre de renseignements concernant votre situation et votre besoin en assurance. Il est de votre intérêt de répondre avec complétude afin de vous proposer un contrat cohérent.
    </p>

    <div class="section">
        <div class="section-title">INFORMATIONS CONCERNANT LE SOUSCRIPTEUR</div>
        
        <div class="field">
            <span class="field-label">Civilité :</span>
            <span class="field-value">{{ $data['civilite'] ?? '' }}</span>
        </div>
        
        <table style="margin-bottom: 10px;">
            <tr>
                <td width="50%">
                    <div class="field">
                        <span class="field-label">Nom d'usage :</span>
                        <span class="field-value">{{ $data['nom_usage'] ?? '' }}</span>
                    </div>
                </td>
                <td width="50%">
                    <div class="field">
                        <span class="field-label">Nom de naissance :</span>
                        <span class="field-value">{{ $data['nom_naissance'] ?? '' }}</span>
                    </div>
                </td>
            </tr>
        </table>

        <div class="field">
            <span class="field-label">Prénoms :</span>
            <span class="field-value">{{ $data['prenoms'] ?? '' }}</span>
        </div>

        <table>
            <tr>
                <td width="50%">
                    <div class="field">
                        <span class="field-label">Date de naissance :</span>
                        <span class="field-value">{{ $data['date_naissance'] ?? '' }}</span>
                    </div>
                </td>
                <td width="50%">
                    <div class="field">
                        <span class="field-label">Situation familiale :</span>
                        <span class="field-value">{{ $data['situation_familiale'] ?? '' }}</span>
                    </div>
                </td>
            </tr>
        </table>

        <div class="field">
            <span class="field-label">Adresse et résidence fiscale :</span>
            <span class="field-value">{{ $data['adresse'] ?? '' }}</span>
        </div>

        <table>
            <tr>
                <td width="50%">
                    <div class="field">
                        <span class="field-label">Email :</span>
                        <span class="field-value">{{ $data['email'] ?? '' }}</span>
                    </div>
                </td>
                <td width="50%">
                    <div class="field">
                        <span class="field-label">Téléphone mobile :</span>
                        <span class="field-value">{{ $data['telephone_mobile'] ?? '' }}</span>
                    </div>
                </td>
            </tr>
        </table>

        <div class="field">
            <span class="field-label">Êtes-vous une Personne Politiquement Exposée (PPE) ?</span>
            <span class="field-value">{{ $data['ppe'] ?? '' }}</span>
        </div>

        @if(($data['ppe'] ?? '') === 'Oui')
        <div class="field">
            <span class="field-label">Fonction exercée :</span>
            <span class="field-value">{{ $data['fonction_exercee'] ?? '' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Date de cessation :</span>
            <span class="field-value">{{ $data['date_cessation'] ?? '' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Lien avec la PPE :</span>
            <span class="field-value">{{ $data['lien_ppe'] ?? '' }}</span>
        </div>
        @endif

        <div class="field">
            <span class="field-label">Quelle est votre profession ?</span>
            <span class="field-value">{{ $data['profession'] ?? '' }}</span>
        </div>

        <div class="field">
            <span class="field-label">Quel est votre Régime social ?</span>
            <span class="field-value">{{ $data['regime_social'] ?? '' }}</span>
        </div>

        <div class="field">
            <span class="field-label">Souhaitez-vous bénéficier des avantages du cadre Madelin ?</span>
            <span class="field-value">{{ $data['madelin'] ?? '' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">DESCRIPTION DU BESOIN EN ASSURANCE</div>

        <div class="field">
            <strong>En cas de décès</strong><br>
            {{ $data['besoins_deces'] ?? '' }}
        </div>

        <div class="field">
            <strong>En cas d'incapacité de travail</strong><br>
            {{ $data['besoins_incapacite'] ?? '' }}
        </div>

        @if(!empty($data['besoins_dependance']))
        <div class="field">
            <strong>En cas de dépendance</strong><br>
            {{ $data['besoins_dependance'] }}
        </div>
        @endif

        <div class="field">
            <span class="field-label">Avez-vous des besoins spécifiques ?</span>
            <span class="field-value">{{ $data['besoins_specifiques'] ?? '' }}</span>
        </div>

        <div class="field">
            <strong>Description détaillée du besoin :</strong><br>
            {{ $data['description_besoin'] ?? '' }}
        </div>

        <div class="field">
            <span class="field-label">Il s'agit :</span>
            <span class="field-value">{{ $data['type_souscription'] ?? '' }}</span>
        </div>
    </div>

    <div class="footer">
        <p><strong>PROTECTION DES DONNÉES PERSONNELLES</strong></p>
        <p style="font-size: 8px;">
            Les données personnelles recueillies dans le cadre du présent questionnaire font l'objet d'un traitement informatisé.<br>
            Le responsable de traitement est : Monsieur Raphaël JACOB<br>
            Vos données sont collectées pour répondre au besoin en assurance exprimé et pour permettre à votre intermédiaire de répondre à ses obligations légales notamment la lutte contre le blanchiment et le financement du terrorisme.<br>
            Les données personnelles sont destinées exclusivement aux services internes de gestion du courtier.<br>
            Le courtier / le mandataire conserve les données personnelles collectées tant que celles-ci lui sont nécessaires, ce délai pouvant dépendre des délais de prescription applicables ou des délais de conservation imposés par la Loi.<br>
            Conformément à la loi Informatique et Libertés du 6 janvier 1978 modifiée et au Règlement européen n°2016/679/UE du 27 avril 2016 dit RGPD, vous disposez d’un droit d’accès, de communication, rectification, d’effacement de vos données, d’un droit à la limitation ou à l’opposition du traitement de vos données et de portabilité des données vous concernant. Vous pouvez exercer ces droits, ou ceux du défunt en tant qu’ayant droit, en vous adressant à Monsieur Raphaël JACOB, 173 Boulevard Pereire 75017 Paris – rjacob.pafipro@gmail.com . En cas de doute, l’intermédiaire pourra vous demander de justifier de votre identité.<br><br>
            Pour toute réclamation ou information, vous pouvez également contacter la Commission Nationale de  l’Informatique et des Libertés (www.cnil.fr) par courrier postal adressé à CNIL, 3, place de Fontenoy, TSA 80715, 75334 Paris cedex 07.<br><br>
            Après vérification de l’ensemble des informations communiquées, je certifie par la présente leur exactitude.<br>
        </p>
        
        <div style="margin-top: 30px;">
            <table>
                <tr>
                    <td width="50%">
                        Fait à __________ le __________
                    </td>
                    <td width="50%"></td>
                </tr>
                <tr>
                    <td width="50%" style="padding-top: 20px;">
                        <strong>Signature du client :</strong><br>
                        (porter la mention « lu et approuvé »)
                    </td>
                    <td width="50%" style="padding-top: 20px;">
                        <strong>Signature du conseiller :</strong>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <footer>
        ParFiPro au capital de 1000 €  - Siège social 173 Boulevard Pereire 75017 Paris<br>
        SIREN – 880 874 466 RCS de Paris – ORIAS 200 01 570 – www.orias.fr<br>
        Sous le contrôle de l'ACPR – 4 place de Budapest CS 92459 75346 Paris cedex 9<br>
        www.parfipro.com – Tel : 06-34-68-07-95 – contact@parfipro.com
    </footer>
</body>
</html>