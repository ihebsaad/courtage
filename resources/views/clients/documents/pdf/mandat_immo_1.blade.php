<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Document d'entrée en relation</title>
    <style>
        @page { margin: 80px 50px 100px 50px; }
        body { font-family: Arial, sans-serif; font-size: 9px; line-height: 1.3; }
        .header-box { padding: 8px; margin-bottom: 15px; text-align: center; font-size: 8px; line-height: 1.4;margin-top:-80px; }
        .title { font-size: 20px; font-weight: bold; text-align: center; margin: 15px 0;border-bottom: 2px solid #000; padding-bottom: 5px; }
        .section { margin-bottom: 12px; }
        .section-title { font-weight: bold; background-color: #e0e0e0; padding: 5px; margin-bottom: 10px; }
        .checkbox { display: inline-block; width: 12px; height: 12px; border: 1px solid #000; margin-right: 5px; vertical-align: middle; }
        .checkbox.checked::before { content: 'X'; font-weight: bold; font-size: 11px; }
        ul { margin: 5px 0 5px 20px; padding: 0; }
        li { margin-bottom: 3px; }
        .partner-list { columns: 2; -webkit-columns: 2; -moz-columns: 2; font-size: 8px; }
        .box { border: 1px solid #000; padding: 8px; margin: 10px 0; }
        .signature-area { margin-top: 30px; }
        table.signatures { width: 100%; }
        table.signatures td { width: 33.33%; text-align: center; padding: 5px; }
        footer { position: fixed; bottom: -80px; left: 0; right: 0; text-align: center; font-size: 7px; line-height: 1.3; }
    </style>
</head>
<body>
    <div class="header-box"><img src="{{ asset('img/logo.png')}}" width="80" />
    </div>
    <div class="title">Document d'entrée en relation</div>

    <p style="margin-bottom: 10px;">
        En application des différentes législations auxquelles nos activités sont soumises, nous vous prions de trouver ci-après les 
        informations réglementaires qui régiront l'ensemble de nos relations contractuelles.
    </p>

    <p style="margin-bottom: 15px;">
        <strong>Nom du client :</strong> {{ $data['nom_client'] }}<br>
        <span class="checkbox {{ $data['civilite'] === 'MR' ? 'checked' : '' }}"></span> MR
        <span class="checkbox {{ $data['civilite'] === 'MME' ? 'checked' : '' }}"></span> MME<br>
        <span class="checkbox {{ $data['type_client'] === 'PARTICULIER' ? 'checked' : '' }}"></span> PARTICULIER
        <span class="checkbox {{ $data['type_client'] === 'ENTREPRISE' ? 'checked' : '' }}"></span> ENTREPRISE
    </p>

    <div class="section">
        <div class="section-title">STATUTS LEGAUX ET AUTORITES DE TUTELLE</div>
        <p>
            ParFiPro, SAS au capital de 1000€ domicilié au 173 Boulevard Pereire – 75017 Paris<br>
            SIREN : 880 874 466 RCS Paris NAF/APE : 6619B<br>
            www.parfipro.com – Tel : 06-34-68-07-95<br>
            Votre conseiller ParFiPro : {{ $data['nom_conseiller'] }}
        </p>
    </div>

    <div class="section">
        <div class="section-title">Intermédiation en opérations de banque et service de paiement</div>
        <p>
            ParFiPro est immatriculée auprès de l'ORIAS sous le n°200 01 570 (www.orias.fr) au titre des activités 
            réglementées suivantes :<br>
            <strong>Intermédiation en opérations de banque et service de paiement</strong><br>
            Courtier en opérations de banque et service de paiement (IOB)
        </p>
        
        <p style="margin-top: 8px;"><strong>Partenaires bancaires et en services de paiement du mandant</strong></p>
        <div class="partner-list">
            * LCL<br>
            * Crédit Mutuel<br>
            * BRED<br>
            * Caixa<br>
            * Bank B<br>
            * CIC<br>
            * Banque Populaire<br>
            * Louvres Banque privée<br>
            * SG<br>
            * Banque Transatlantique<br>
            * Banque Palatine<br>
            * Bourso Bank<br>
            * Quintet<br>
            * Bill
        </div>

        <p style="margin-top: 8px; font-size: 8px;">
            Le conseiller peut percevoir des honoraires versés par le client en cas de fourniture d'un conseil indépendant.
        </p>
    </div>

    <div class="section">
        <div class="section-title">Intermédiation en assurance</div>
        <p>
            Catégorie d'intermédiaire *ParFiPro est une société de courtage d'assurance positionnée dans la catégorie « b » selon l'article 
            L.520 II 1 du Code des Assurances, sous le contrôle de l'Autorité de Contrôle Prudentiel et de Résolution 
            ACPR, 61 rue Taitbout, 75346 Paris Cedex 9. Elle n'est pas soumise à une obligation contractuelle de 
            travailler exclusivement avec une ou plusieurs entreprises d'assurance.
        </p>
    </div>

    <div class="section">
        <div class="section-title">Service de conseil indépendant portant sur des crédits immobiliers, hypothécaires, professionnels</div>
        <p>
            Le conseiller propose un service de conseil au sens de l'article L. 519-1-1 du Code monétaire et financier portant sur des 
            contrats de crédit immobiliers, hypothécaires, professionnels.
        </p>
        <p>Les recommandations émises par le conseiller à ce titre portent sur :</p>
        <p>
            • Sur une large gamme de contrats de crédit disponibles sur le marché ; lors de la fourniture de ce service, notre cabinet 
            perçoit habituellement des honoraires de conseil d'un montant libre fixé au début de la mission.
        </p>
    </div>

    <div class="section">
        <div class="section-title">Agent Immobilier</div>
        <p>
            ParFiPro est titulaire d'une carte professionnelle d'agent immobilier enregistrée à la préfecture de Paris, sous le numéro 
            CPI 7501 2025 000 000 230, sans détention de fonds, délivrée le 22/05/2025.
        </p>
        <p>
            Le conseiller peut proposer au client les prestations de conseil suivantes :<br>
            Une prestation de conseil de Niveau 2 : émettre une recommandation personnalisée consistant à 
            expliquer au client pourquoi, parmi plusieurs solutions, une ou plusieurs correspondent le mieux à 
            ses exigences et besoins.
        </p>
        <p>
            Dans ce cadre, le conseiller est non soumis à une obligation contractuelle de travailler exclusivement 
            avec une ou plusieurs établissements de crédit ou entreprises d'assurance.
        </p>
    </div>

    <div class="section">
        <div class="section-title">Rémunération</div>
        <p>
            La rémunération perçue pour l'activité de courtier en assurance provient d'une part de commissions ou rétrocessions 
            versées par les compagnies d'assurance ou/et honoraires d'étude qui vous sont directement facturés.
        </p>
        <p>
            <strong>1. Par les partenaires bancaires et financiers :</strong> un commissionnement au titre de la mission d'intermédiation calculé en 
            pourcentage du montant des crédits accordés et soumis à plafonnement.<br>
            Chaque partenaire détermine le pourcentage et le plafond de cette commission.
        </p>
        <p>
            <strong>2. Honoraires de courtage :</strong><br>
            La rémunération (commission et honoraires de courtage) n'est due qu'après versement des fonds, dans le cadre des 
            missions d'intermédiation.
        </p>
        <p>
            Liste des établissements bancaires et en services de paiement qui représentent sur l'année passée, une part supérieure au 
            tiers du chiffre d'affaires, au titre de l'activité d'intermédiation : NEANT
        </p>
        <p>
            Liste des établissements bancaires et en services de paiement détenant, directement ou indirectement plus de 10% des 
            droits de vote ou du capital de notre cabinet : NEANT
        </p>
        <p>
            Liste des établissements bancaires et en services de paiement où notre cabinet a une participation, directe ou indirecte, 
            supérieure à 10 % de droits de vote ou de capital : NEANT
        </p>
    </div>

    <div class="section">
        <div class="section-title">Conseil – Audit</div>
        <div class="box">
            <p><strong>Rémunération :</strong></p>
            <p>
                Les études de faisabilité peuvent être rémunérés par une somme forfaitaire allant de 
                500€ HT à 10 000€ HT en fonction de la durée, de la complexité et des sommes concernées.
            </p>
        </div>
        <div class="box">
            <p><strong>Rémunération :</strong></p>
            <p>
                Les activés de prestations immobilières seront rémunérées par des commissions à la charge du vendeur 
                ou de l'acquéreur, en fonction du type de bien, et de la complexité du travail à effectuer.<br>
                Cette rémunération sera comprise entre 1% HT et 6% HT (soit 1,20% TTC à 7,20% TTC).
            </p>
        </div>
    </div>

    <div class="section">
        <div class="section-title">RCP</div>
        <p>
            Votre conseiller dispose, conformément à la loi et à tous les codes de bonne conduite de la CNCEF, d'une couverture en 
            Responsabilité Civile Professionnelle et d'une Garantie Financière suffisantes couvrant ses diverses activités. Ces 
            couvertures sont notamment conformes aux exigences du code monétaire et financier et du code des assurances. Elles 
            sont souscrites auprès de AIG sous le numéro de polices : RD01452752A
        </p>
        <table style="width: 100%; margin: 10px 0; font-size: 8px;">
            <tr>
                <td style="width: 33%; padding: 5px; border: 1px solid #000; text-align: center;">
                    <strong>IOBSP IAS</strong><br>
                    1.564.610 € par sinistre et 2.315.610 € par période d'assurance.
                </td>
                <td style="width: 33%; padding: 5px; border: 1px solid #000; text-align: center;">
                    <strong>Garantie financière</strong><br>
                    Pour des montants de 500.000€ par sinistre<br>
                    Limité à 800.000€ par an
                </td>
                <td style="width: 34%; padding: 5px; border: 1px solid #000; text-align: center;">
                    1.500.000€ par sinistre<br>
                    Limité à 2.000.000€ par an
                </td>
            </tr>
        </table>
        <p style="font-size: 8px;">
            Votre conseiller s'est engagé à respecter intégralement tous les codes de bonne conduite de la CNCEF disponibles au siège 
            de l'association ou sur www.cncef.org
        </p>
    </div>

    <div class="section">
        <div class="section-title">Procédure de réclamation – médiation</div>
        <p>
            En cas de désaccord, une solution amiable sera envisagée en premier lieu après la réception 
            d'une réclamation sur support durable adressée à :
        </p>
        <p>
            Par courrier à l'adresse suivante :<br>
            173 Boulevard Pereire – 75017 Paris
        </p>
        <p>
            Par courriel à l'adresse suivante :<br>
            rjacob.parfipro@gmail.com
        </p>
        <p>
            Nous nous engageons à accuser réception de la réclamation dans un délai de dix jours ouvrables puis 
            à y répondre dans un délai de deux mois à compter de la réception de la réclamation. En cas de litige 
            et si la réponse apportée à sa réclamation ne lui apparaît pas satisfaisante, le client consommateur 
            peut ensuite saisir le médiateur de la consommation suivant en vue de sa résolution amiable :
        </p>
        <p>
            Par courrier à l'adresse suivante :<br>
            CMAP – Service Médiation de la consommation<br>
            39 avenue F.D. Roosevelt<br>
            75008 Paris
        </p>
        <p>
            Par courriel à l'adresse suivante :<br>
            consommation@cmap.fr
        </p>
    </div>

    <div class="section">
        <div class="section-title">Traitement des données personnelles</div>
        <p>
            En application des dispositions de la loi n° 78-17 du 6 janvier 1978 et du Règlement 2016/679 du 
            Parlement européen et du Conseil du 27 avril 2016 relatif à la protection des personnes 
            physiques à l'égard du traitement des données à caractère personnel et à la libre circulation de 
            ces données, le cabinet s'engage à ne collecter et traiter les données recueillies qu'au regard des 
            finalités de traitement convenues entre le cabinet et son client, à préserver leur sécurité et 
            intégrité, à ne communiquer ces informations qu'à des tiers auxquels il serait nécessaire de les 
            transmettre en exécution des prestations convenues, et plus généralement à agir dans le cadre des 
            exigences réglementaires auxquelles il est soumis. Le client est informé qu'il a le droit de demander 
            au responsable de traitement l'accès aux données à caractère personnel, leurs catégories et leurs 
            destinataires, la durée de leur conservation ou, à défaut, les critères utilisés pour déterminer 
            cette durée, leur rectification, leur effacement et leur portabilité, ainsi que le droit de demander 
            une limitation du traitement de ses données à caractère personnel, sur simple demande sur support 
            durable (courrier, email, etc…).
        </p>
        <p>
            L'identité et les coordonnées du responsable de traitement au sein du cabinet sont les suivantes :<br>
            -Raphaël JACOB – 06-34-68-07-95 – rjacob.parfipro@gmail.com
        </p>
        <p>
            L'identité et les coordonnées du délégué à la protection des données au sein du cabinet sont les suivantes :<br>
            -Raphaël JACOB – 06-34-68-07-95 – rjacob.parfipro@gmail.com
        </p>
        <p>
            Le client a le droit d'introduire une réclamation auprès de la Commission Nationale de l'Informatique 
            et des Libertés (CNIL) à l'adresse suivante :<br>
            Commission Nationale de l'Informatique et des Libertés (CNIL)<br>
            3 Place de Fontenoy<br>
            TSA 80715<br>
            75334 PARIS CEDEX 07
        </p>
    </div>

    <div class="section">
        <div class="section-title">Autorité de tutelle</div>
        <p>ACPR – Autorité de Contrôle Prudentiel et de Résolution - 61 rue Taitbout 75009 Paris</p>
        
        <div class="section-title" style="margin-top: 10px;">Registre</div>
        <p>ORIAS – Organisme pour le registre unique des intermédiaires en assurance, banque et finance – 1 rue 
            Jules Lefebvre 75009 Paris - www.orias.fr</p>
        
        <div class="section-title" style="margin-top: 10px;">Mise à jour</div>
        <p>
            Le Conseiller fait parvenir au client toute mise à jour de ces différentes informations, en lui communiquant par mail.<br>
            Le client peut également obtenir à tout moment ces informations sur simple demande auprès du conseiller.
        </p>
    </div>

    <div class="box" style="font-size: 8px; margin: 15px 0;">
        <p>
            Un crédit vous engage et doit être remboursé. Vérifiez vos capacités de remboursement avant de vous engager.<br>
            Aux termes de l'article L. 519-6 du Code monétaire et financier, « il est interdit à toute personne physique ou morale 
            qui apporte son concours, à quelque titre que ce soit et de quelque manière que ce soit, directement ou 
            indirectement, à l'obtention ou à l'octroi d'un prêt d'argent, de percevoir une somme représentative de 
            provision, de commissions, de frais de recherche, de démarches, de constitution de dossier ou d'entremise 
            quelconque, avant le versement effectif des fonds prêtés. Il lui est également interdit, avant la remise 
            des fonds et de la copie de l'acte, de présenter à l'acceptation de l'emprunteur des lettres de change, ou de lui faire 
            souscrire des billets à ordre, en recouvrement des frais d'entremise ou des commissions mentionnés à l'alinéa précédent. 
            Les infractions aux dispositions des premier et deuxième alinéa du présent article sont recherchées et constatées 
            dans les conditions fixées à l'article L. 353-5 et sont punies des peines prévues à l'article L. 353-1 ». La diminution du 
            montant des mensualités entraîne l'allongement de la durée de remboursement et majore le coût total du crédit. 
            La réduction dépend de la durée restante des prêts rachetés.
        </p>
    </div>

    <div class="signature-area">
        <p>Fait à {{ $data['fait_a'] }}, le {{ \Carbon\Carbon::parse($data['date_document'])->format('d/m/Y') }}</p>
        
        <table class="signatures">
            <tr>
                <td>
                    <strong>[Client] -</strong><br>
                    Signature précédée de "Lu et approuvé"<br><br><br>
                </td>
                <td>
                    <strong>[Client] -</strong><br>
                    Signature précédée de "Lu et approuvé"<br><br><br>
                </td>
                <td>
                    <strong>[Conseiller] - {{ $data['nom_conseiller'] }}</strong><br>
                    Signature précédée de "Lu et approuvé"<br><br><br>
                </td>
            </tr>
        </table>
    </div>

    <footer>
        ParFiPro au capital de 1000 €  - Siège social 173 Boulevard Pereire 75017 Paris<br>
        SIREN – 880 874 466 RCS de Paris – ORIAS 200 01 570 – www.orias.fr<br>
        Sous le contrôle de l'ACPR – 4 place de Budapest CS 92459 75346 Paris cedex 9<br>
        www.parfipro.com – Tel : 06-34-68-07-95 – contact@parfipro.com
    </footer>

</body>
</html>