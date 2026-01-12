<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Document d'Entrée en Relation</title>
    <style>
        @page { margin: 80px 50px 100px 50px; }
        body { font-family: Arial, sans-serif; font-size: 9px; line-height: 1.3; }
        .header-box { padding: 8px; margin-bottom: 15px; text-align: center; font-size: 8px; line-height: 1.4;margin-top:-80px; }
        .title { font-size: 20px; font-weight: bold; text-align: center; margin: 15px 0;border-bottom: 2px solid #000; padding-bottom: 5px; }
        .section { margin-bottom: 12px; }
        .section-title { font-weight: bold; background-color: #e0e0e0; padding: 5px; margin-bottom: 10px; }
        footer { position: fixed; bottom: -80px; left: 0; right: 0; text-align: center; font-size: 7px; line-height: 1.3; }

        .field { margin-bottom: 5px; }
        .compagnies { columns: 3; -webkit-columns: 3; -moz-columns: 3; font-size: 9px; margin: 10px 0; }
        .signature-block { margin-top: 40px; }
        table { width: 100%; }
        td { padding: 5px; vertical-align: top; }
    </style>
</head>
<body>
    <header>
    <div class="header-box">
        <img src="{{ asset('img/logo.png')}}" width="80" />
    </div>
    <div class="title">DOCUMENT D'ENTRÉE EN RELATION</div>

    <p style="margin-bottom: 15px; font-style: italic;">
        Vous êtes entré en relation avec un intermédiaire en assurances dont l'activité est réglementée et contrôlée.
        La présente fiche comporte toutes les informations légales que cet intermédiaire doit vous communiquer lors de l'entrée en relation.
    </p>

    <div class="section">
        <div class="section-title">Informations préalables sur l'intermédiaire</div>
        <p>
            La société ParFiPro, représentée par Monsieur Raphaël JACOB, est immatriculée au registre unique des 
            intermédiaires en assurance, banque et finance (ORIAS - 1 rue Jules Lefebvre à Paris 75009) sous le 
            numéro <strong>200 01 570</strong> (consultable sur le site www.orias.fr) en qualité de <strong>Courtier d'assurance (COA)</strong>.
        </p>
        <p>
            ParFiPro, SASU, au capital de 1 000€, est immatriculé(e) au RCS de Paris, sous le numéro 880 874 466, 
            et a son siège social au 173 Boulevard Pereire 75017 Paris (téléphone : 06.34.68.07.95 ; 
            courriel : rjacob.parfipro@gmail.com ; site internet www.parfipro.com)
        </p>
        <p>
            La société ParFiPro est assurée au titre de sa responsabilité civile professionnelle auprès de la 
            compagnie <strong>AIG</strong>, contrats n° <strong>RD01452752A</strong>.
        </p>
        <p>
            La société ParFiPro est contrôlée par son Autorité de tutelle : l'Autorité de Contrôle Prudentiel et de 
            Résolution (ACPR) 4 Place de Budapest – CS 92459 – 75436 PARIS cedex 09.<br>
            Site internet : http://www.acpr.banque-france.fr
        </p>
        <p>
            La société ParFiPro est adhérente à la <strong>CNCEF Assurance</strong>, association professionnelle.
        </p>
    </div>

    <div class="section">
        <div class="section-title">Informations préalables relatives à la fourniture du contrat</div>
        <p>
            L'intermédiaire n'entretient pas de relation significative de nature capitalistique ou commerciale 
            avec une entreprise d'assurance (participation > à 10 % des droits de vote ou du capital).
        </p>
        <p>
            La société ParFiPro n'est pas soumis(e) à une obligation contractuelle de travailler exclusivement 
            avec une ou plusieurs entreprises d'assurance. Pour ce contrat, la société ParFiPro fonde son analyse 
            sur un nombre restreint de contrats présents sur le marché et les noms des entreprises d'assurance 
            avec lesquelles elle travaille sont les suivants :
        </p>
        <div class="compagnies">
            SWISSLIFE • MALAKOFF HUMANIS • AESIO • SPVIE • ZEPHIR • ALPTIS • CEGEMA • MODULASSUR • 
            ZENIOO • ACPS • Ilona • ECA • ENTORIA • APICIL • HUMINDIS • TUTASSUR • LUXIOR • ASAF AFPS
        </div>
    </div>

    <div class="section">
        <div class="section-title">Informations quant à la rémunération</div>
        <p>
            Pour ce contrat, ParFiPro sera rémunéré sur la base : 
            <strong>{{ $data['type_remuneration'] === 'commission' ? 'd\'une commission (rémunération incluse dans la prime d\'assurance)' : 'd\'honoraires' }}</strong>
        </p>
    </div>

    <div class="section">
        <div class="section-title">Informations sur la procédure de réclamation et le recours au processus de médiation</div>
        
        <p><strong>Saisine du service interne de réclamation :</strong></p>
        <p>
            En cas de mécontentement vous pouvez formuler une réclamation écrite auprès de notre service interne de réclamation.
            Le service réclamation peut être contacté selon les modalités suivantes :
        </p>
        <ul style="margin-left: 20px;">
            <li>Par courrier : Service réclamation, 173 Boulevard Pereire 75017 Paris</li>
            <li>Par mail : rjacob.parfipro@gmail.com</li>
        </ul>
        <p>Personne à contacter en charge du suivi des réclamations : <strong>Monsieur Raphaël JACOB</strong>.</p>

        <p><strong>Saisine du médiateur de la consommation :</strong></p>
        <p>
            Si le client consommateur n'est pas satisfait de la réponse apportée à sa réclamation, il peut saisir 
            gratuitement le médiateur de la consommation.
        </p>
        <p>Le Médiateur de la consommation compétent est :<br>
            <strong>CMAP – Service Médiation de la consommation – 39 Avenue F.D. Roosevelt 75008 Paris</strong><br>
            consommation@cmap.fr
        </p>
        <p>
            Pour les clients consommateurs, le médiateur de la consommation peut en tout état de cause être saisi 
            deux mois après l'envoi d'une première réclamation écrite, quel que soit l'interlocuteur ou le service 
            auprès duquel elle a été formulée et qu'il y ait été ou non répondu.
        </p>
        <p style="font-size: 9px; font-style: italic;">
            Cette saisine ne peut intervenir qu'après épuisement des voies de recours internes, doit préciser l'objet 
            du litige et être accompagnée des pièces justificatives.
        </p>
        <p>
            Le consommateur doit saisir le Médiateur soit en utilisant le formulaire en ligne 
            (https://www.cmap.fr/contact/), soit par courrier électronique (consommation@cmap.fr), soit par courrier 
            postal (39 avenue F.D. Roosevelt 75008 Paris)
        </p>
    </div>

    <div class="signature-block">
        <p>
            Je soussigné(e) <strong>{{ $client->nom_complet }}</strong> atteste avoir reçu, pris connaissance et 
            compris les informations données dans le cadre du présent document.
        </p>
        <p style="margin-top: 10px;">Établi en deux exemplaires, dont un remis au client</p>
        <p>Fait à Paris, le {{ $data['date_entree_relation'] ?? '___________' }}</p>
        
        <table style="margin-top: 30px;">
            <tr>
                <td width="50%" style="text-align: center;">
                    <strong>Signature du client</strong><br><br><br><br>
                </td>
                <td width="50%" style="text-align: center;">
                    <strong>Signature du conseiller</strong><br><br><br><br>
                </td>
            </tr>
        </table>
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