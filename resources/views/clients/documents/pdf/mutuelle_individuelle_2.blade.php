<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Document de Recueil des Exigences et des Besoins</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; line-height: 1.4; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .section { margin-bottom: 20px; }
        .section-title { font-weight: bold; background-color: #e0e0e0; padding: 5px; margin-bottom: 10px; }
        .field { margin-bottom: 8px; }
        .field-label { font-weight: bold; display: inline-block; width: 200px; }
        .field-value { display: inline-block; border-bottom: 1px solid #000; min-width: 300px; }
        .footer { font-size: 9px; border-top: 1px solid #000; padding-top: 10px; margin-top: 30px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 5px; vertical-align: top; }
        footer {
		   position: fixed;
		   bottom: -120px;
		   left: 0px;
		   right: 0px;
		   height: 100px;
		   text-align: center;
		   font-size:10px;
		   line-height:11px;
		   font-weight:normal;
		   page-break-inside: avoid;
	   }
    </style>
</head>
<body>
    <div class="header">
        <h2>DOCUMENT DE RECUEIL DES EXIGENCES ET DES BESOINS</h2>
    </div>

    <p style="margin-bottom: 15px;">
        Dans le cadre de son activité réglementée, votre courtier / intermédiaire doit recueillir un certain 
        nombre de renseignements concernant votre situation et votre besoin en assurance.
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
            Les données personnelles recueillies dans le cadre du présent questionnaire font l'objet d'un traitement informatisé.
            Conformément à la loi Informatique et Libertés du 6 janvier 1978 modifiée et au Règlement européen n°2016/679/UE 
            du 27 avril 2016 dit RGPD, vous disposez d'un droit d'accès, de communication, rectification, d'effacement de vos données.
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
        <p style="font-size: 8px; text-align: center; margin-top: 20px;">
            ParFiPro - Courtier en assurances - au capital de 1000 € - Siège social : 173 Boulevard Pereire 75017 Paris - 
            SIREN : 880 874 466 RCS de Paris - ORIAS : 200 01 570 - www.parfipro.fr
        </p>
    </footer>
</body>
</html>