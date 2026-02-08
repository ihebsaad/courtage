<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Convention de Prestations d'assistance et de recherche en financement</title>
    <style>
        @page { margin: 80px 50px 100px 50px; }
        body { font-family: Arial, sans-serif; font-size: 9px; line-height: 1.4; }
        .header-box { padding: 8px; margin-bottom: 15px; text-align: center; font-size: 8px; line-height: 1.4; margin-top: -80px; }
        .title { font-size: 16px; font-weight: bold; text-align: center; margin: 15px 0; border-bottom: 2px solid #000; padding-bottom: 5px; }
        .section { margin-bottom: 15px; }
        .section-title { font-weight: bold; background-color: #333; color: #fff; padding: 5px; margin: 10px 0 8px 0; font-size: 10px; }
        .subsection-title { font-weight: bold; margin: 8px 0 5px 0; font-size: 9px; }
        footer { position: fixed; bottom: -80px; left: 0; right: 0; text-align: center; font-size: 7px; line-height: 1.3; }
        .parties { margin: 15px 0; }
        .party-box { border: 1px solid #000; padding: 8px; margin: 8px 0; }
        .signature-area { margin-top: 30px; page-break-inside: avoid; }
        table.signatures { width: 100%; border-collapse: collapse; }
        table.signatures td { width: 50%; text-align: center; padding: 5px; vertical-align: top; }
        ul { margin: 5px 0 5px 20px; padding: 0; list-style: none; }
        li { margin-bottom: 3px; }
        p { margin: 5px 0; }
        .montant { font-weight: bold; }
        .etablissement { margin-bottom: 8px; }
    </style>
</head>
<body>
    <div class="header-box">
        <img src="{{ asset('img/logo.png')}}" width="80" />
    </div>

    <div class="title">Convention de Prestations d'assistance et de recherche en financement</div>

    <div class="parties">
        <p style="font-weight: bold; margin-bottom: 10px;">ENTRE LES SOUSSIGNES</p>
        
        <p><strong>{{ $data['civilite_mandant'] ?? 'Monsieur' }}</strong> {{ $data['nom_mandant'] ?? '' }} {{ $data['prenom_mandant'] ?? '' }}, demeurant {{ $data['adresse_mandant'] ?? '' }}, né(e) le {{ $data['date_naissance_mandant'] ?? '00/01/1900' }}</p>

        @if(!empty($data['nom_conjoint']))
        <p><strong>{{ $data['civilite_conjoint'] ?? 'Madame' }}</strong> {{ $data['nom_conjoint'] ?? '' }} {{ $data['prenom_conjoint'] ?? '' }}, demeurant {{ $data['adresse_conjoint'] ?? '' }}, né(e) le {{ $data['date_naissance_conjoint'] ?? '00/01/1900' }}</p>
        @endif

        <p style="margin: 10px 0;"><strong>ci-après dénommé « le Mandant »,</strong></p>

        <div class="party-box">
            <p>La Société <strong>ParFiPro</strong>, au capital social 1000€, ayant son siège social au 173 Boulevard Pereire 75017 Paris, RCS de Paris sous le numéro 880 874 466, dont le code NAF est 6619B, représentée par Monsieur Raphaël JACOB en sa qualité de Président.</p>
        </div>

        <p style="margin: 10px 0;"><strong>ci-après dénommée « le Mandataire »,</strong></p>
    </div>

    <div class="section-title">LE MANDANT DONNE POUVOIR SPECIAL AU MANDATAIRE D'EFFECTUER EN SON NOM ET POUR SON COMPTE AUPRES DES ETABLISSEMENTS DE CREDIT PARTENAIRES OU NON DU CONSEILLER SUIVANTS :</div>

    <div class="etablissement">
        <p>*Etablissement de crédit ; <strong>Le Crédit Lyonnais</strong>, Société anonyme au capital social de 2 037 713 591€, dont le siège social est 18 rue de la république BP 2351 69215 LYON Cedex 2, enregistrée sous le numéro RCS 954 509 741, représentée par M Michel MATHIEU</p>
    </div>

    <div class="etablissement">
        <p>*Etablissement de crédit ; <strong>Crédit Industriel et Commercial</strong>, Société anonyme au capital social de 611 858 064€, dont le siège social est 6 Avenue de Provence 75009 Paris, enregistrée sous le numéro RCS 542 016 381 représentée par M Daniel BAAL</p>
    </div>

    <div class="etablissement">
        <p>*Etablissement de crédit ; <strong>Banque Populaire Rives de Paris</strong>, Société coopérative de banque populaire au capital social de 5 000 000€, dont le siège social est 80 Boulevard Auguste Blanqui 75013 Paris, enregistrée sous le numéro RCS 552 002 313, représentée par M Boris JOSEPH</p>
    </div>

    <div class="etablissement">
        <p>*Etablissement de crédit ; <strong>Banque Populaire Val de France</strong>, Société coopérative de banque populaire au capital social de 394 466 200€, dont le siège social est 9 Avenue Newton 78180 Montigny-Le Bretonneux, enregistrée sous le numéro RCS 549 800 373, représentée par M Mathieu REQUILLART</p>
    </div>

    <div class="etablissement">
        <p>*Etablissement de crédit ; <strong>Banque Populaire Bourgogne Franche-Comté</strong>, Autre Société anonyme à conseil d'administration au capital social inconnu, dont le siège social est 14 Boulevard de la Trémouille 21000 Dijon, enregistrée sous le numéro RCS 542 820 352, représentée par M François TAILLEFER DE LAPORTALIERE</p>
    </div>

    <div class="etablissement">
        <p>*Etablissement de crédit ; <strong>Crédit Mutuel Ile de France</strong>, Caisse fédérale de crédit mutuel au capital social de 24 393 306.27€, dont le siège social est 18 Rue de la Rochefoucauld 75009 Paris, enregistrée sous le numéro RCS 692 043 714, représentée par M Raphaël REBERT</p>
    </div>

    <div class="etablissement">
        <p>*Etablissement de crédit ; <strong>Société Générale</strong>, Société anonyme au capital social de 1 010 261 206.25€, dont le siège social est 29 Boulevard Haussmann 75009 Paris, enregistrée sous le numéro RCS 552 120 222, représentée par Frédéric OUDEA</p>
    </div>

    <div class="etablissement">
        <p>*Etablissement de crédit ; <strong>Crédit Agricole Ile de France</strong>, Caisse de crédit agricole mutuel au capital social de 113 772 496€, dont le siège social est 26 Quai de la Rapee 75012 Paris, enregistrée sous le numéro RCS 775 6645 615, représentée par M Michel GANZIN</p>
    </div>

    <div class="etablissement">
        <p>*Etablissement de crédit ; <strong>Caisse d'Epargne Ile de France</strong>, Caisse d'Epargne et de Prévoyance au capital social de 2 375 000 000€, dont le siège social est 19 rue du Louvre 75036 Paris Cedex 01, enregistrée sous le numéro RCS 382 900 942, représentée par NC</p>
    </div>

    <div class="etablissement">
        <p>*Etablissement de crédit ; <strong>BNP PARIBAS</strong>, Société anonyme au capital social de 2 468 663 292€, dont le siège social est 16 Boulevard Des Italiens 75009 Paris, enregistrée sous le numéro RCS 662 042 449, représentée par M Jean-Laurent BONNAFE</p>
    </div>

    <div class="etablissement">
        <p>*Etablissement de crédit ; <strong>La Banque Postale</strong>, Société anonyme au capital social de 6 585 350 218€, dont le siège social est 115 Rue de Sèvres 75275 Paris Cedex 06, enregistrée sous le numéro RCS 421 100 645, représentée par NC</p>
    </div>

    <div class="etablissement">
        <p>*Etablissement de crédit ; <strong>BRED BANQUE POPULAIRE</strong>, Autre Société anonyme à conseil d'administration au capital social de 1 681 431 905.79€, dont le siège social est 18 Quai de la Rapée 75012 Paris, enregistrée sous le numéro RCS 552 091 795, représentée par M Jean-Paul JULIA</p>
    </div>

    <div class="section-title">CONSTITUE PAR LES PRESENTES, COMME SON MANDATAIRE SPECIAL</div>

    <div class="section-title">CONCERNANT LE PROJET DE FINANCEMENT SUIVANT :</div>

    <p class="montant">Un crédit immobilier d'un montant de {{ number_format($data['montant_credit'] ?? 0, 0, ',', ' ') }} €</p>
    <p>(sous réserve de modifications éventuelles de l'apport et/ou du montant total du projet).</p>
    <p>En vue de financer (objet) : <strong>{{ $data['objet_financement'] ?? 'Achat habitation principale' }}</strong></p>
    <p>A destination de : <strong>{{ $data['destination'] ?? 'Achat résidence principale sans travaux' }}</strong>.</p>
    <p class="montant">Apport personnel de : {{ number_format($data['apport_personnel'] ?? 0, 0, ',', ' ') }} €</p>

    <div class="section-title">LES OPERATIONS, PRESTATIONS ET ACTES SUIVANTS EN SON NOM ET POUR SON COMPTE :</div>

    <ul>
        <li>-Dépôt d'un dossier de financement auprès des établissements de crédit susmentionnés</li>
        <li>-Suivi dudit dossier de financement auprès des établissements de crédit susmentionnés par téléphone, email, rendez-vous physique, télécopie, lors de l'instruction de la demande de crédit</li>
        <li>-Recueil des propositions de financement</li>
    </ul>

    <p style="margin-top: 8px;">Et plus généralement, d'effectuer tout acte d'intermédiation en son nom et pour son compte auprès desdits établissements, dans les conditions fixées aux articles L. 519-1 et suivants du Code monétaire et financier.</p>

    <div class="section-title">ENGAGEMENTS DES PARTIES</div>

    <p class="subsection-title">Le Mandataire :</p>
    <ul>
        <li>-S'engage à agir dans l'intérêt exclusif du Mandant.</li>
        <li>-S'oblige à ne pas déléguer les pouvoirs en vertu du présent Mandat.</li>
    </ul>

    <p style="margin-top: 8px;">Le Mandant reconnaît que seule une obligation de moyens est mise à la charge du Mandataire, ce mandat ne comportant aucune obligation de résultats ou engagement de garantie.</p>

    <p style="margin-top: 8px;">Le présent mandat est donné conformément aux dispositions des articles 1984 et suivants du Code civil.</p>

    <p>Il sera révocable conformément aux dispositions des articles 2004 et suivants du Code civil. Cette révocation sera notifiée par le Mandant (ou son représentant) à Monsieur Raphaël JACOB (le Mandataire).</p>

    <p>Le Mandant (ou son représentant) et le Mandataire reconnaissent que les opérations objet du présent mandat sont conformes à la volonté des parties.</p>

    <p style="margin-top: 15px;">Le présent mandat prendra effet le <strong>{{ \Carbon\Carbon::parse($data['date_debut_mandat'] ?? now())->format('d/m/Y') }}</strong> et prendra fin le <strong>{{ \Carbon\Carbon::parse($data['date_fin_mandat'] ?? now()->addMonths(3))->format('d/m/Y') }}</strong></p>

    <div class="signature-area">
        <p>Fait à {{ $data['fait_a'] ?? 'Paris' }}, le {{ \Carbon\Carbon::parse($data['date_debut_mandat'] ?? now())->format('d/m/Y') }}</p>
        
        <table class="signatures">
            <tr>
                <td>
                    <strong>[Mandant] - {{ $data['nom_mandant'] ?? '' }} {{ $data['prenom_mandant'] ?? '' }}</strong><br>
                    @if(!empty($data['nom_conjoint']))
                    <strong>[Mandant] - {{ $data['nom_conjoint'] ?? '' }} {{ $data['prenom_conjoint'] ?? '' }}</strong><br>
                    @endif
                    Signature précédée de «Bon pour acceptation de mandat »<br><br><br><br>
                </td>
                <td>
                    <strong>[Mandataire] - Raphaël JACOB</strong><br>
                    Signature précédée de «Bon pour acceptation de mandat »<br><br><br><br>
                </td>
            </tr>
        </table>
    </div>

    <footer>
        <table style="text-align: center; width: 70%; margin-left: 15%;">
            <tr>
                <td style="width: 40%;">
                    <img src="{!! public_path('img/cncef.png')!!}" width="180" style="text-align:center"></img><br>
                </td>
                <td style="width: 60%;">
                    ParFiPro au capital de 1000 € - Siège social 173 Boulevard Pereire 75017 Paris<br>
                    SIREN – 880 874 466 RCS de Paris – ORIAS 200 01 570 – www.orias.fr<br>
                    Sous le contrôle de l'ACPR – 4 place de Budapest CS 92459 75346 Paris cedex 9<br>
                    www.parfipro.com – Tel : 06-34-68-07-95 – rjacob.parfipro@gmail.com
                </td>
            </tr>
        </table>
    </footer>

</body>
</html>