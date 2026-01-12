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
        .section-title { font-weight: bold; background-color: #000; color: #fff; padding: 5px; margin: 10px 0 8px 0; font-size: 10px; }
        .subsection-title { font-weight: bold; margin: 8px 0 5px 0; font-size: 9px; }
        footer { position: fixed; bottom: -80px; left: 0; right: 0; text-align: center; font-size: 7px; line-height: 1.3; }
        .checkbox { display: inline-block; width: 12px; height: 12px; border: 1px solid #000; margin-right: 5px; vertical-align: middle; }
        .checkbox.checked::before { content: 'X'; font-weight: bold; font-size: 11px; }
        .parties { margin: 15px 0; }
        .party-box { border: 1px solid #000; padding: 8px; margin: 8px 0; }
        .signature-area { margin-top: 30px; page-break-inside: avoid; }
        table.signatures { width: 100%; }
        table.signatures td { width: 33.33%; text-align: center; padding: 5px; vertical-align: top; }
        ul { margin: 5px 0 5px 20px; padding: 0; }
        li { margin-bottom: 3px; }
        p { margin: 5px 0; }
        .montant { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header-box">
        <img src="{{ asset('img/logo.png')}}" width="80" />
    </div>

    <div class="title">Convention de Prestations d'assistance et de recherche en financement</div>

    <div class="parties">
        <p style="font-weight: bold; margin-bottom: 10px;">ENTRE LES SOUSSIGNES</p>
        
        <p><strong>{{ $data['civilite_client1'] ?? 'Monsieur' }}</strong> {{ $data['nom_client1'] ?? '' }} {{ $data['prenom_client1'] ?? '' }}, demeurant {{ $data['adresse_client1'] ?? '' }}, né(e) le {{ $data['date_naissance_client1'] ? \Carbon\Carbon::parse($data['date_naissance_client1'])->format('d/m/Y') : '00/01/1900' }}</p>

        @if(!empty($data['nom_client2']))
        <p><strong>{{ $data['civilite_client2'] ?? 'Madame' }}</strong> {{ $data['nom_client2'] ?? '' }} {{ $data['prenom_client2'] ?? '' }}, demeurant {{ $data['adresse_client2'] ?? '' }}, né(e) le {{ $data['date_naissance_client2'] ? \Carbon\Carbon::parse($data['date_naissance_client2'])->format('d/m/Y') : '00/01/1900' }}</p>
        @endif

        <p style="margin: 10px 0;"><strong>Ci-après le « Client »,</strong></p>
        <p style="text-align: right; margin-bottom: 15px;"><strong>D'UNE PART,</strong></p>

        <div class="party-box">
            <p>La Société <strong>ParFiPro</strong>, au capital social 1000€, ayant son siège social au 173 Boulevard Pereire 75017 Paris, RCS de Paris sous le numéro 880 874 466, dont le code NAF est 6619B, représentée par Monsieur Raphaël JACOB en sa qualité de Président.</p>
            <p style="margin-top: 8px;">SOCIETE au capital de 1000 €<br>
            Siège social 173 Boulevard Pereire 75017 Paris<br>
            SIREN –880 874 466 RCS de Paris –<br>
            ORIAS 200 01 570 – www.orias.fr<br>
            Sous le contrôle de l'ACPR – 4 place de Budapest CS 92459 75346 Paris cedex 9</p>
        </div>

        <p style="margin: 10px 0;"><strong>Ci-après le « Conseiller »,</strong></p>
        <p style="text-align: right; margin-bottom: 15px;"><strong>D'AUTRE PART,</strong></p>
        <p style="text-align: center; font-style: italic; margin: 15px 0;">Ci-après dénommés ensemble les « Parties »</p>
    </div>

    <div class="section-title">IL A TOUT D'ABORD ETE EXPOSE CE QUI SUIT :</div>

    <p>Le Client souhaite être assisté dans un projet de recherche de financement consistant en :</p>
    <p class="montant">Un crédit immobilier d'un montant de {{ number_format($data['montant_credit'] ?? 0, 0, ',', ' ') }} € {{ $data['montant_credit'] ? '' : 'zéro euro' }}</p>
    <p>(sous réserve de modifications éventuelles de l'apport et/ou du montant total du projet).</p>
    <p>En vue de financer (objet) <strong>{{ $data['objet_financement'] ?? 'Achat' }}</strong></p>
    <p>A destination de : <strong>{{ $data['destination'] ?? 'Achat résidence principale sans travaux' }}</strong>.</p>
    <p class="montant">Apport personnel de : {{ number_format($data['apport_personnel'] ?? 0, 0, ',', ' ') }} € {{ $data['apport_personnel'] ? '' : 'zéro euro' }}</p>

    <p style="margin-top: 10px;">A travers les services et de prestations qu'il propose (les « Prestations »), le Conseiller a vocation à faciliter et d'optimiser cette recherche. Le Client et le Conseiller ont ainsi décidé de se rapprocher en vue de définir par le présent contrat (le « Contrat ») les termes de la mission confiée au Conseiller par le Client à ce titre.</p>

    <div class="section-title">1. Objet</div>
    <p>Le présent Contrat a pour objet de définir les conditions dans lesquelles le Conseiller fournira les Prestations au Client, c'est-à-dire les droits et obligations de chacune des Parties concernant de telles Prestations.</p>

    <div class="section-title">2. Prestations confiées au Conseiller</div>
    <p class="subsection-title">2.1. Le Client confie au Conseiller les Prestations suivantes :</p>
    <ul>
        <li><span class="checkbox checked"></span>Etude et diagnostic de la situation personnelle et financière du Client ayant pour objet de déterminer et d'évaluer sa situation patrimoniale, sa capacité d'endettement et sa solvabilité ;</li>
        <li><span class="checkbox checked"></span>Assistance du Client dans la constitution administrative des dossiers de financement présentés aux établissements de crédit partenaires ou non du Conseiller, préconisations et optimisation de leur présentation ;</li>
        <li><span class="checkbox checked"></span>Assistance du Client dans la préparation des rendez-vous avec les établissements de crédit partenaires ou non du Conseiller, avec organisation de réunions préparatoires et/ou assistance téléphonique à disposition du Client.</li>
        <li><span class="checkbox checked"></span>Etude des propositions de financement recueillies et assistance dans le choix de l'établissement de crédit retenu.</li>
    </ul>

    <p class="subsection-title">2.2.</p>
    <p>Concernant certains établissements de crédit listés en Annexe 1 du présent Contrat, le Client confie également au Conseiller un mandat spécial de recherche de financement permettant à ce dernier de présenter le dossier du Client directement auprès desdits établissements de crédit au nom et pour son compte, dans les conditions fixées en Annexe 1.</p>

    <div class="section-title">3. Engagements du Conseiller</div>
    <p class="subsection-title">3.1 Engagements du Conseiller au titre de la Prestation</p>
    <p>Le Conseiller s'engage à mettre tout son soin à la bonne exécution de la Prestation convenue entre les Parties au titre du présent Contrat dans l'intérêt exclusif du Client, en bon professionnel et conformément aux normes d'exercice professionnel ainsi qu'aux obligations législatives et règlementaires auxquelles il est soumis.</p>
    <p>Les obligations du Conseiller quant à l'exécution de la Prestation convenue entre les Parties au titre du présent article sont des obligations de moyens. Le Conseiller ne saurait donc accorder au Client aucune garantie expresse ou tacite de quelque nature que ce soit, concernant la Prestation fournie, ni aucune garantie de bonne fin concernant les opérations éventuellement réalisées.</p>

    <p class="subsection-title">3.2 Ressources humaines</p>
    <p>Le cas échéant, le Conseiller s'engage à ne faire intervenir que des collaborateurs ayant l'honorabilité, l'intégrité, les statuts, la capacité et les compétences nécessaires et adéquats à la bonne réalisation des travaux exigés sur la Prestation.</p>

    <p class="subsection-title">3.3 Confidentialité</p>
    <p>Le Conseiller traitera de manière strictement confidentielle tous les documents, analyses et informations recueillis dans le cadre de la Prestation fournie. Par exception, le Conseiller pourra être amené à communiquer à un tiers des informations relatives à la Prestation fournie consécutivement à une obligation légale, réglementaire, judiciaire, administrative. Par ailleurs, la Prestation qui sera fournie par le Conseiller procède de l'analyse de la situation spécifique du Client et sera adressée à sa seule attention. En conséquence, les conseils ou services fournis au titre de la Prestation pourront seulement être utilisés par le Client ou toute personne de son entourage préalablement désignée et ne pourront en aucun cas être divulgués ou utilisés par des tiers sans accord préalable du Conseiller.</p>

    <div class="section-title">4. Engagements du Client</div>
    <p>Le Client s'engage à communiquer au Conseiller et à lui fournir dans la plus grande transparence toutes les informations et documents nécessaires à la bonne connaissance des conditions d'exécution de la Prestation. Le Client doit faire connaitre ses décisions, ses choix, et, d'une manière générale, toutes ses observations, de toute nature, au Conseiller.</p>
    <p>Le Client s'engage à communiquer sans délai au Conseiller toute modification des informations pouvant affecter la Prestation. Le Client a conscience que le Conseiller ne pourra réaliser la Prestation en l'absence de ces informations et documents, ou en présence d'informations erronées.</p>
    <p>Le Client s'engage à indiquer au Conseiller les démarches qu'il a déjà effectuées par rapport à l'objet du Contrat, les mandataires ou établissements financiers qu'il a déjà sollicités avant la signature du présent Contrat, et, le cas échéant, à informer le Conseiller de tous les contacts qu'il aura établis avec des établissements de crédit, ainsi que des décisions d'acceptation ou de refus de la demande de financement qu'il aura présentée avec l'assistance du Conseiller dans les conditions susmentionnées.</p>
    <p>Le Client s'engage à informer le Conseiller de la solution financière et du partenaire financier qu'il aura trouvé si le présent Contrat devait être rompu ou mené à son terme sans résultats.</p>

    <div class="section-title">5. Rémunération</div>
    <p>Au titre de la Prestation visée à l'article 2.1, le Client s'engage à verser au Conseiller des honoraires d'un montant de <span class="montant">{{ number_format($data['montant_honoraires'] ?? 0, 0, ',', ' ') }} € {{ $data['montant_honoraires'] ? '' : 'zéro euro' }}</span></p>
    <p>Cette somme est exigible le jour où l'opération objet du présent mandat sera effectivement réalisée. Toutefois, conformément aux dispositions de l'article L.519-6 du Code monétaire et financier, le Mandataire ne pourra la percevoir avant le déblocage effectif des fonds par l'organisme prêteur. Par ailleurs, la banque pourra verser au Mandataire une commission bancaire égale au maximum à 1% du montant du (des) crédit(s) débloqué(s). Si le mandataire ne trouve pas de financement adéquat, et sous réserves des exceptions contractuellement prévues ci-dessous, aucune rémunération d'aucune sorte ne lui sera due (article L519-6 du Code Monétaire et Financier).</p>
    <p style="margin-top: 8px;"><strong>Une rémunération sera donc néanmoins due au mandataire dans les hypothèses suivantes :</strong></p>
    <p>Dans l'hypothèse d'un financement accordé directement par la banque du mandant ou par toute autre banque, sans l'intermédiation directe du mandataire mais aux moyens de ses préconisations / conseils / études et conditions obtenues par ailleurs, le mandant devra verser au courtier la rémunération définie ci-dessus.</p>
    <p>Si le mandant arrête l'opération avant son terme ou s'il refuse une ou plusieurs offres de prêts, ou s'il se rétracte du prêt obtenu et conforme au mandat confié, il s'interdit de traiter tout ou partie de l'opération avec les prêteurs contactés avant l'arrêt de l'opération, ou tout autre prêteur et ce pendant une durée d'un an et un jour, faute de quoi, les honoraires forfaitaires deviendraient exigibles de plein droit dès le déblocage des fonds.</p>
    <p style="margin-top: 8px;">Dans ce cadre, la rémunération versée par l'établissement bancaire est calculée en pourcentage du montant des crédits accordés et soumise à plafonnement. Conformément à l'article L. 519-6 du Code monétaire et financier, il est interdit à toute personne physique ou morale qui apporte son concours, à quelque titre que ce soit et de quelque manière que ce soit, directement ou indirectement, à l'obtention ou à l'octroi d'un prêt d'argent, de percevoir une somme représentative de provision, de commissions, de frais de recherche, de démarches, de constitution de dossier ou d'entremise quelconque, avant le versement effectif des fonds prêtés.</p>

    <div class="section-title">6. Frais et débours</div>
    <p>Les frais que le Conseiller serait amené à engager pour l'exécution de la Prestation après accord préalable du Client lui seront facturés en sus sur la facture et remboursés sur présentation de tout justificatifs présentant les dépenses ; il s'agit notamment des frais annexes de traduction, reprographie etc.…, pour les missions en dehors du lieu de la prestation, des frais de déplacement, d'hébergement et de repas.</p>
    <p>Les prix s'entendent toujours hors taxes françaises et étrangères : les factures établies par le Conseiller tiennent compte des dispositions fiscales et sociales en vigueur et, au cas où celles-ci seraient modifiées, les variations de prix qui en résulteraient prendraient effet dès le jour de leur mise en application.</p>

    <div class="section-title">7. Obligations à la charge des Parties</div>
    <p>La Prestation sera exécutée dans le cadre d'une coopération étroite et active entre le Client et son Conseiller. A ce titre, chaque Partie s'engage à maintenir une collaboration régulière en assurant un climat de loyauté et d'efficacité. Les obligations contractuelles de chacune des Parties seront exécutées en toute bonne foi dans le cadre des conditions conjointement convenues.</p>

    <div class="section-title">8. Responsabilité</div>
    <p>Le Conseiller n'est responsable que de l'accomplissement de la Prestation confiée par le Client au titre du présent Contrat, à l'exclusion de toute autre responsabilité ou garantie.</p>

    <div class="section-title">9. Traitement des données personnelles</div>
    <p>Les informations recueillies à l'occasion de la conclusion et de l'exécution du présent Contrat sont traitées en vue de la bonne réalisation de ce dernier et des obligations du Conseiller. Elles sont conservées pendant cinq ans à la fin de la relation contractuelle entre les Parties, ou de la fin du contrat de crédit souscrit suite aux actes d'intermédiation réalisés pour le compte du Client en cas de conclusion d'un mandat de recherche de financement dans les conditions fixées à l'Annexe 1. Elles peuvent être transmises aux partenaires bancaires et de services de paiement en cas de conclusion d'un mandat de recherche de financement dans les conditions fixées à l'Annexe 1. Le Client peut exercer l'ensemble de ses droits liés au traitement des données personnelles selon les modalités indiquées dans le cadre du document d'entrée en relation préalablement remis au Client (le « DER »).</p>

    <div class="section-title">10. Durée du Contrat - entrée en vigueur – dénonciation</div>
    <p>Le présent Contrat est conclu à compter de sa date de signature par les Parties pour une durée initiale de 3 mois.</p>
    <p>A l'issue de cette durée initiale, ce dernier est renouvelé par tacite reconduction par périodes successives de 3 mois, sauf dénonciation par l'une quelconque des Parties intervenant par lettre recommandée avec demande d'avis de réception adressée 1 mois avant l'expiration de la durée initiale ou de chaque période renouvelée.</p>

    <div class="section-title">11. Délai de rétractation</div>
    <p class="subsection-title">si démarchage :</p>
    <p>En cas de démarchage du Client par le Conseiller, la personne démarchée dispose d'un délai de rétractation de quatorze (14) jours calendaires révolus, conformément à l'article L. 341-16 du Code monétaire et financier. Le Client exerce son droit de rétractation en informant le Conseiller de sa décision de se rétracter par l'envoi du formulaire de rétractation qui lui a été fournie par le Conseiller ou de toute autre déclaration, dénuée d'ambiguïté, exprimant sa volonté de se rétracter.</p>
    <p><span class="checkbox"></span>Informé de son droit de rétractation, le Client déclare par la présente souhaiter que des Prestations puissent être exécutées dès la conclusion du présent Contrat.</p>
    <p>A ce titre, le Client peut revenir sur son engagement, même si des Prestations ont commencé avant l'expiration de ce délai. Dans cette hypothèse, le Client, exerçant son droit de rétractation après une exécution partielle de Prestations accepte alors de rémunérer le Conseiller, qui en ferait la demande, à hauteur du service effectivement fourni selon les modalités de calcul suivantes : 100€ / jours dans la limite des honoraires convenus pour la mission.</p>

    <p class="subsection-title" style="margin-top: 10px;">si vente à distance (précédée ou non de démarchage)</p>
    <p>Conclusion à distance : en excluant la présence physique simultanée du Conseiller et du Client, et en recourant exclusivement, de la négociation jusqu'à la conclusion du contrat, à une technique de communication à distance : offre en ligne, par téléphone, exclusivement par courrier électronique etc.</p>
    <p>Si le présent Contrat a été conclu à distance dans les conditions fixées aux articles L.222-1 et suivants du Code de la Consommation, le Client dispose d'un droit de rétractation de quatorze (14) jours pour exercer son droit à rétractation à compter du jour de la signature des présentes. Le Client exerce son droit de rétractation en informant le Conseiller de sa décision de se rétracter par l'envoi du formulaire de rétractation qui lui a été fournie par le Conseiller ou de toute autre déclaration, dénuée d'ambiguïté, exprimant sa volonté de se rétracter.</p>
    <p><span class="checkbox"></span>Informé de son droit de rétractation, le Client déclare par la présente souhaiter que des Prestations puissent être exécutées dès la conclusion du présent Contrat.</p>
    <p>A ce titre, le Client peut revenir sur son engagement, même si des Prestations ont commencé avant l'expiration de ce délai. Dans cette hypothèse, le Client, exerçant son droit de rétractation après une exécution partielle de Prestations accepte alors de rémunérer le Conseiller, qui en ferait la demande, à hauteur du service effectivement fourni selon les modalités de calcul suivantes : 100€ / jours dans la limite des honoraires convenus pour la mission.</p>
    <div class="section-title">12. Notifications</div>
    <p>Toute notification et/ou communication dans le cadre du présent Contrat devra être effectuée aux coordonnées suivantes :</p>
    <p style="margin: 8px 0;"><strong>Pour le Client</strong><br>
    Nom / Prénom : {{ $data['nom_client1'] ?? '' }} {{ $data['prenom_client1'] ?? '' }}<br>
    Adresse postale : {{ $data['adresse_client1'] ?? '' }}<br>
    Numéro(s) de téléphone : {{ $client->telephone_portable ?? '' }}<br>
    Adresse Email : {{ $client->email ?? '' }}</p>

    @if(!empty($data['nom_client2']))
    <p style="margin: 8px 0;"><strong>Pour la Cliente</strong><br>
    Nom / Prénom : {{ $data['nom_client2'] ?? '' }} {{ $data['prenom_client2'] ?? '' }}<br>
    Adresse postale : {{ $data['adresse_client2'] ?? '' }}<br>
    Numéro(s) de téléphone :<br>
    Adresse Email :</p>
    @endif

    <p style="margin: 8px 0;"><strong>Pour le Conseiller</strong><br>
    [Conseiller] - Raphaël JACOB<br>
    Adresse postale : 173 Boulevard Pereire 75017 Paris<br>
    Numéro(s) de téléphone : 06.34.68.07.95<br>
    Adresse Email : rjacob.parfipro@gmail.com</p>

    <p>Toute mise à jour des coordonnées par l'une des Partie sera portée à la connaissance de l'autre Partie par tout moyen approprié sans signature d'un avenant au présent Contrat.</p>

    <div class="section-title">13. Réclamations Client - Médiation</div>
    <p>Pour toute réclamation concernant la Prestation, le Client s'adresse préalablement et sur support durable au Conseiller. Le Conseiller s'engage à traiter la réclamation dans les conditions détaillées dans le DER. Le DER comporte également toutes les informations relatives au médiateur compétent si le Client souhaite y avoir recours en vue de la résolution amiable du litige qui l'oppose au Conseiller.</p>

    <div class="section-title">14. Droit applicable et tribunaux compétents</div>
    <p>Les dispositions du présent Contrat sont régies et soumises au droit français.</p>
    <p>Tout litige relatif à l'exécution ou à l'interprétation du présent Contrat pourra être soumis à médiation pour rechercher une solution amiable avant tout recours à une procédure judiciaire, dans les conditions fixées par l'article 13 du présent Contrat.</p>
    <p>A défaut, tout litige sera soumis aux tribunaux compétents dans le ressort duquel se situe le siège social du Conseiller.</p>

    <div class="signature-area">
        <p>Fait à {{ $data['fait_a'] ?? 'Paris' }}, le {{ \Carbon\Carbon::parse($data['date_debut_mandat'] ?? now())->format('d/m/Y') }}</p>
        
        <table class="signatures">
            <tr>
                <td>
                    <strong>[Client] - {{ $data['nom_client1'] ?? '' }}</strong><br>
                    Signature précédée de « Lu et approuvé »<br><br><br><br>
                </td>
                @if(!empty($data['nom_client2']))
                <td>
                    <strong>[Client] - {{ $data['nom_client2'] ?? '' }}</strong><br>
                    Signature précédée de « Lu et approuvé »<br><br><br><br>
                </td>
                @endif
                <td>
                    <strong>[Conseiller] - Raphaël JACOB</strong><br>
                    Signature précédée de « Lu et approuvé »<br><br><br><br>
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