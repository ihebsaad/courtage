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
        footer { position: fixed; bottom: -80px; left: 0; right: 0; text-align: center; font-size: 7px; line-height: 1.3; }

        .checkbox { display: inline-block; width: 12px; height: 12px; border: 1px solid #000; margin-right: 5px; vertical-align: middle; }
        .checkbox.checked::before { content: 'X'; font-weight: bold; font-size: 11px; }
        ul { margin: 5px 0 5px 20px; padding: 0; }
        li { margin-bottom: 3px; }
        .partner-list { columns: 2; -webkit-columns: 2; -moz-columns: 2; font-size: 8px; }
        .box { border: 1px solid #000; padding: 8px; margin: 10px 0; }
        .signature-area { margin-top: 30px; }
        table.signatures { width: 100%; }
        table.signatures td { width: 33.33%; text-align: center; padding: 5px; }
    </style>
</head>
<body>
    <script type="text/php">
    if (isset($pdf)) {
     //Shows number center-bottom of A4 page with $x,$y values
        $x = 520;  //X-axis i.e. vertical position
        $y = 820; //Y-axis horizontal position
        $text = "Page {PAGE_NUM} / {PAGE_COUNT}";  //format of display message
        $font =  $fontMetrics->get_font("helvetica", "bold");
        $size = 8;
        $color = array(0,0,0);
        $color2 = array(136,136,136);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        //$pdf->page_text(30, $y,' ' , $font, $size, $color, $word_space, $char_space, $angle);
    }
    </script>    
    <div class="header-box">
        <img src="{{ asset('img/logo.png')}}" width="80" />
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
        <p>
            ParFiPro est immatriculée auprès de l'ORIAS sous le n°200 01 570 (www.orias.fr) au titre des activités 
            réglementées suivantes :<br>
            <strong>Intermédiation en opérations de banque et service de paiement</strong><br>
            Courtier en opérations de banque et service de paiement (IOB)
        </p>
    </div>

    <div class="section">
        <div class="section-title">Intermédiation en opérations de banque et service de paiement</div>

        
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
        <b>Rémunération :</b>
        <p style="margin-top: 8px;">
        1. Par les partenaires bancaires et financiers : un commissionnement au titre de la mission d’intermédiation calculé en
        pourcentage du montant des crédits accordés et soumis à plafonnement.<br>
        Chaque partenaire détermine le pourcentage et le plafond de cette commission.
        </p>
        <p style="margin-top: 8px;">
        2. Honoraires de courtage :<br>
        La rémunération (commission et honoraires de courtage) n’est due qu’après versement des fonds, dans le cadre des
        missions d’intermédiation.<br>
        Liste des établissements bancaires et en services de paiement qui représentent sur l’année passée, une part supérieure au
        tiers du chiffre d’affaires, au titre de l’activité d’intermédiation : NEANT<br>
        Liste des établissements bancaires et en services de paiement détenant, directement ou indirectement plus de 10% des
        droits de vote ou du capital de notre cabinet : NEANT<br>
        Liste des établissements bancaires et en services de paiement où notre cabinet a une participation, directe ou indirecte,
        supérieure à 10 % de droits de vote ou de capital : NEANT<br>
        Service de conseil indépendant portant sur des crédits immobiliers, hypothécaires, professionnels<br>
        Le conseiller propose un service de conseil au sens de l’article L. 519-1-1 du Code monétaire et financier portant sur des
        contrats de crédit immobiliers, hypothécaires, professionnels.<br>
        Les recommandations émises par le conseiller à ce titre portent sur :<br>
        • Sur une large gamme de contrats de crédit disponibles sur le marché ; lors de la fourniture de ce service, notre cabinet
        perçoit habituellement des honoraires de conseil d’un montant libre fixé au début de la mission.
        </p>

        <p style="margin-top: 8px; font-size: 8px;">
            Le conseiller peut percevoir des honoraires versés par le client en cas de fourniture d'un conseil indépendant.
        </p>
    </div>

    <div class="section">
        <div class="section-title">Intermédiation en assurance</div>
        <p>
            <b>Catégorie d'intermédiaire </b><br>
            *ParFiPro est une société de courtage d'assurance positionnée dans la catégorie « b » selon l'article 
            L.520 II 1 du Code des Assurances, sous le contrôle de l'Autorité de Contrôle Prudentiel et de Résolution 
            ACPR, 61 rue Taitbout, 75346 Paris Cedex 9. Elle n'est pas soumise à une obligation contractuelle de 
            travailler exclusivement avec une ou plusieurs entreprises d'assurance.            
        </p>
        <p>
            <b>Rémunération : </b><br>
            La rémunération perçue pour l’activité de courtier en assurance provient d’une part de commissions ou rétrocessions
            versées par les compagnies d’assurance ou/et honoraires d’étude qui vous sont directement facturés. 
        </p>
    </div>

    <div class="section">
        <div class="section-title">Conseil – Audit</div>
        <p>
            Le conseiller peut proposer au client les prestations de conseil suivantes :<br>
            Une prestation de conseil de Niveau 2 : émettre une recommandation personnalisée consistant à
            expliquer au client pourquoi, parmi plusieurs solutions, une ou plusieurs correspondent le mieux à
            ses exigences et besoins.<br>
            Dans ce cadre, le conseiller est non soumis à une obligation contractuelle de travailler exclusivement avec une ou plusieurs établissements de crédit ou entreprises d’assurance.
        </p>
        <p>
            <b>Rémunération : </b><br>
            Les études de faisabilité peuvent être rémunérés par une somme forfaitaire allant de 500€ HT à 10 000€ HT en fonction de la durée, de la complexité et des sommes concernées. 
        </p>
    </div>

    <div class="section">
        <div class="section-title">Agent Immobilier</div>
        <p>
            ParFiPro est titulaire d'une carte professionnelle d'agent immobilier enregistrée à la préfecture de Paris, sous le numéro 
            CPI 7501 2025 000 000 230, sans détention de fonds, délivrée le 22/05/2025.
        </p>
        <p>
            Votre conseiller dispose, conformément à la loi et à tous les codes de bonne conduite de la CNCEF, d’une couverture en
            Responsabilité Civile Professionnelle et d’une Garantie Financière suffisantes couvrant ses diverses activités. Ces
            couvertures sont notamment conformes aux exigences du code monétaire et financier et du code des assurances. Elles
            sont souscrites auprès de AIG sous le numéro de polices : RD01452752A
        </p>
        <table  style="width: 100%; margin: 10px 0; font-size: 8px; border-collapse: collapse;">
            <tr><th>Pour des montants de </th><th>IOBSP</th><th>IAS</th></tr>
            <tr><td>RCP</td><td colspan="2">1.564.610 € par sinistre et 2.315.610 € par période d'assurance.</td></tr>
            <tr><td>Garantie financière</td><td>500.000€ par sinistre Limité à 800.000€ par an</td><td>1.500.000€ par sinistre Limité à 2.000.000€ par an</td></tr>
        </table>
        <p>
            Votre conseiller s’est engagé à respecter intégralement tous les codes de bonne conduite de la CNCEF disponibles au siège
            de l’association ou sur www.cncef.org
        </p>
        <p>
            <b>Rémunération : </b><br>
            Les activés de prestations immobilières seront rémunérées par des commissions à la charge du vendeur ou de l’acquéreur, en fonction du type de bien, et de la complexité du travail à effectuer.<br>
            Cette rémunération sera comprise entre 1% HT et 6% HT (soit 1,20% TTC à 7,20% TTC).
        </p>
    </div>

     <div class="section">
        <div class="section-title">Procédure de réclamation – médiation</div>
     </div>

    <div class="section">
        <div class="section-title">Traitement des données personnelles</div>
     </div>

    <div class="section">
        <div class="section-title">Autorité de tutelle</div>
     </div>

    <div class="section">
        <div class="section-title">Registre</div>
     </div>
    <div class="section">
        <div class="section-title">Mise à jour</div>
    </div>
    <div class="signature-area">
        <p>Fait à {{ $data['fait_a'] }}, le {{ \Carbon\Carbon::parse($data['date_document'])->format('d/m/Y') }}</p>
        <div style="width:100%">
            <table class="signatures" style="width:50%;float:left">
                <tr>
                    <td>
                        <strong>[Conseiller] - Raphaël JACOB</strong><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        Signature précédée de "Lu et approuvé"<br><br><br><br><br>
                    </td>
                </tr>
            </table>
            <table class="signatures" style="width:50%;float:left">
                <tr>
                    <td>
                        <strong>[Client] -</strong><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        Signature précédée de "Lu et approuvé"<br><br><br><br><br>
                    </td>
                </tr>            
                <tr>
                    <td>
                        <strong>[Client] -</strong><br>
                        Signature précédée de "Lu et approuvé"<br><br><br><br><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>[Client] -</strong><br>
                        Signature précédée de "Lu et approuvé"<br><br><br><br><br>
                    </td>
                </tr>            
            </table>
        </div>
    </div>

    <footer>
        <table style="text-align: center; width: 70%;margin-left:15% ;">
            <tr>
                <td style="width: 40%;">
                    <img src="{!! public_path('img/cncef.png')!!}"  width="180" style="text-align:center"></img><br>
                </td>
                <td style="width: 60%;">
                    ParFiPro au capital de 1000 €  - Siège social 173 Boulevard Pereire 75017 Paris<br>
                    SIREN – 880 874 466 RCS de Paris – ORIAS 200 01 570 – www.orias.fr<br>
                    Sous le contrôle de l'ACPR – 4 place de Budapest CS 92459 75346 Paris cedex 9<br>
                    www.parfipro.com – Tel : 06-34-68-07-95 – rjacob.parfipro@gmail.com
                </td>
            </tr>
        </table>
    </footer>

</body>
</html>