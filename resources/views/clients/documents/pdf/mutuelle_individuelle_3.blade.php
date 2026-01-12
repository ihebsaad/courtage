<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fiche Conseil</title>
    <style>
        @page { margin: 80px 50px 100px 50px; }
        body { font-family: Arial, sans-serif; font-size: 9px; line-height: 1.3; }
        .header-box { padding: 8px; margin-bottom: 15px; text-align: center; font-size: 8px; line-height: 1.4;margin-top:-80px; }
        .title { font-size: 20px; font-weight: bold; text-align: center; margin: 15px 0;border-bottom: 2px solid #000; padding-bottom: 5px; }
        .section { margin-bottom: 12px; }
        .section-title { font-weight: bold; background-color: #e0e0e0; padding: 5px; margin-bottom: 10px; }
        footer { position: fixed; bottom: -80px; left: 0; right: 0; text-align: center; font-size: 7px; line-height: 1.3; }

        .subsection-title { font-weight: bold; font-size: 11px; margin: 10px 0 5px 0; }
        .field { margin-bottom: 8px; }
        .checkbox-list { margin: 5px 0; }
        .checkbox-item { margin: 3px 0; }
        .signature-block { margin-top: 40px; }
        table { width: 100%; }
        td { padding: 5px; vertical-align: top; }
        .box { border: 1px solid #000; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="header-box">
        <img src="{{ asset('img/logo.png')}}" width="80" />
    </div>
    <div class="title">FICHE CONSEIL</div>

    <p style="margin-bottom: 15px;">
        <strong>Client :</strong> {{ $data['nom_complet'] ?? '' }}
    </p>

    <p style="margin-bottom: 15px; font-style: italic;">
        Au regard des besoins et des exigences que vous avez décrits dans le cadre du questionnaire de recueil de 
        situation et de besoin en assurances, votre courtier / intermédiaire vous préconise, selon le cas, un ou 
        plusieurs produits à souscrire.
    </p>

    <div class="section">
        <div class="section-title">I – Phase de préconisation</div>
        
        <div class="subsection-title">1/ Rappel des exigences et besoins exprimés</div>
        <p>{{ $data['rappel_besoins'] ?? '' }}</p>

        <div class="subsection-title">2/ Produit(s) préconisé(s)</div>
        <p><strong>{{ $data['produit_preconise'] ?? '' }}</strong></p>
        <p>Commercialisé par la société <strong>{{ $data['compagnie'] ?? '' }}</strong></p>

        <div class="subsection-title">3/ Présentation du(es) produit(s)</div>
        <p>
            Dans le cadre de la fourniture des informations objectives en lien avec le contrat proposé, 
            nous vous avons remis les documents suivants :
        </p>
        <div class="checkbox-list">
            <div class="checkbox-item">- Étude comparative {{ isset($data['doc_etude_comparative']) && $data['doc_etude_comparative'] ? '☑' : '' }}</div>
            <div class="checkbox-item">- Devis {{ isset($data['doc_devis']) && $data['doc_devis'] ? '☑' : '' }}</div>
            <div class="checkbox-item">- Conditions générales {{ isset($data['doc_conditions_generales']) && $data['doc_conditions_generales'] ? '☑' : '' }}</div>
            <div class="checkbox-item">- IPID {{ isset($data['doc_ipid']) && $data['doc_ipid'] ? '☑' : '' }}</div>
            <div class="checkbox-item">- FSI {{ isset($data['doc_fsi']) && $data['doc_fsi'] ? '☑' : '' }}</div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">II – Phase de justification</div>
        
        <div class="subsection-title">Nous vous proposons de souscrire le contrat :</div>
        <p>{{ $data['produit_preconise'] ?? '' }}</p>

        <div class="box">
            <div class="subsection-title">Motivation du conseil</div>
            <p>Ce contrat vous est préconisé pour les raisons suivantes :</p>
            <p>{{ $data['motivation_conseil'] ?? '' }}</p>
        </div>

        <div class="field" style="margin-top: 15px;">
            <strong>Adéquation au marché cible :</strong> {{ $data['adequation_marche'] ?? '' }}
        </div>

        @if(($data['adequation_marche'] ?? '') === 'Non')
        <div class="field">
            <strong>Si non, pourquoi ?</strong><br>
            {{ $data['raison_non_adequation'] ?? '' }}
        </div>
        @endif
    </div>

    <div style="margin-top: 20px; border-top: 1px solid #000; padding-top: 10px;">
        <p>
            Le client reconnaît qu'il s'est vu remettre par son courtier le document normalisé correspondant 
            au(x) produit(s) préconisé(s) (IPID)
        </p>
    </div>

    <div class="signature-block">
        <p>Fait à Paris en deux exemplaires, dont un remis au client,</p>
        <p>Le, ___________</p>
        
        <table style="margin-top: 30px;">
            <tr>
                <td width="50%" style="text-align: center;">
                    <strong>Signature du client ou de son représentant :</strong><br>
                    <span style="font-size: 9px;">(porter la mention « lu et approuvé »)</span>
                    <br><br><br><br>
                </td>
                <td width="50%" style="text-align: center;">
                    <strong>Signature du conseiller :</strong><br><br><br><br><br>
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