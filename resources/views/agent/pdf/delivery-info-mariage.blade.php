<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Étiquette Livraison Extrait de Deces</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        html, body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9pt;
            line-height: 1.2;
        }
        @page {
            size: A6 landscape;
            margin: 0mm 5mm;
        }

        .etiquette-content {
            display: flex;
            padding: 2px 5px 0 5px;
            flex-direction: column;
            justify-content: space-between;
            height: 95%;
        }
        .etiquette-header {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 3px 0;
            font-weight: bold;
            font-size: 12pt;
            letter-spacing: 5px;
            margin-bottom: 4mm;
            flex-shrink: 0;
        }

        .info-header-table,
        .details-table,
        .reference-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4mm;
            flex-shrink: 0;
        }
        .reference-table {
            margin-bottom: 0;
            min-height: 20mm;
        }

        /* Section 1 */
        .info-header-table {
            border: none;
            min-height: 20mm;
        }
        .info-header-table td {
            vertical-align: middle;
            border: none;
        }
        .logo-cell { width: 33%; text-align: left; }
        .address-cell { width: 34%; text-align: center; }
        .qr-cell   { width: 33%; text-align: right; }

        .custom-logo {
            max-width: 100%;
            max-height: 18mm;
            display: block;
            margin-right: auto;
        }
        .address-details {
            font-size: 8pt;
            font-weight: bold;
            line-height: 1.3;
        }
        .address-details strong {
            font-size: 9pt;
            display: block;
            margin-bottom: 1mm;
        }
        .qr-code-img-header {
            max-width: 100%;
            max-height: 22mm;
            display: block;
            margin-left: auto;
        }
        .qr-placeholder {
            font-size: 8pt;
            color: #666;
            text-align: center;
            padding: 5mm 0;
        }

        /* Section 2 */
        .details-table {
            border: 1.5pt solid #000;
        }
        .details-table th {
            background-color: #E0E0E0;
            font-weight: bold;
            font-size: 8.5pt;
            border: 0.5pt solid #000;
            text-align: center;
            padding: 1mm 1.5mm;
        }
        .details-table td {
            border: 0.5pt solid #000;
            vertical-align: top;
            font-size: 12pt;
            font-weight: bold;
            line-height: 1.1;
            padding: 1mm 1.5mm;
        }
        .date-cell { width: 22%; text-align: center; font-size: 11pt; }
        .dest-cell { width: 48%; }
        .exp-cell  { width: 30%; }

        .sub-info {
            font-size: 10pt;
            font-weight: normal;
            margin-top: 1mm;
        }

        /* Section 3 */
        .reference-table {
            border: 1.5pt solid #000;
            display: table;
            table-layout: fixed;
        }
        .reference-table td {
            vertical-align: middle;
            font-size: 12pt;
            font-weight: bold;
            border: 0.5pt solid #000;
            padding: 1mm 2mm;
        }
        .ref-cell { width: 70%; border-right: 1pt solid #000; text-align: left; }
        .count-cell { width: 30%; text-align: center; }

        .qr-code-img-ref {
            max-width: 12mm;
            max-height: 12mm;
            display: inline-block;
            vertical-align: middle;
            margin-right: 2mm;
        }
        .reference-number {
            font-size: 26pt;
            font-weight: bold;
            line-height: 1;
            max-width: calc(100% - 14mm - 2mm);
            word-wrap: break-word;
        }
        .type-colis-info {
            font-size: 8pt;
            margin-top: 1mm;
            text-align: center;
            word-wrap: break-word;
        }
        .counter-text {
            font-size: 26pt;
            font-weight: bold;
            line-height: 1;
            margin-bottom: 1mm;
        }
        .destination-text {
            font-size: 9pt;
            font-weight: bold;
            display: block;
        }

        .etiquette-page:not(.last-page) {
            page-break-after: always !important;
        }

        .bw-logo {
            filter: grayscale(100%) contrast(150%);
        }
        
        .document-type {
            font-size: 10pt;
            font-weight: bold;
            text-align: center;
            margin-top: 2mm;
        }
    </style>
</head>
<body>
    <div class="etiquette-page last-page">
        <div class="etiquette-content">
            <div class="etiquette-header">
                EXTRAT DE MARIAGE - LIVRAISON
            </div>

            {{-- Section Logo / Adresse / QR --}}
            <table class="info-header-table">
                <tr>
                    <td class="logo-cell">
                        @if(file_exists(public_path('assetsHome/img/E-ci.jpg')))
                            <img src="{{ public_path('assetsHome/img/E-ci.jpg') }}" class="custom-logo bw-logo" alt="Logo">
                        @else
                            <p style="font-size:7pt;color:red;">Logo absent</p>
                        @endif
                    </td>
                    <td class="address-cell">
                        <div class="address-details">
                            <strong>MAIRIE - ÉTAT CIVIL</strong>
                            Service des Extraits de mariage<br>
                            @if(isset($mairie_adresse))
                                {{ $mairie_adresse }}<br>
                            @endif
                            @if(isset($mairie_telephone))
                                Tél: {{ $mairie_telephone }}
                            @endif
                        </div>
                    </td>
                    <td class="qr-cell">
                        @if($naissance->qr_code_path && file_exists(public_path('storage/' . $naissance->qr_code_path)))
                            <img src="{{ public_path('storage/' . $naissance->qr_code_path) }}" class="qr-code-img-header" alt="QR Code">
                        @else
                            <div class="qr-placeholder">QR Code<br>Absent</div>
                        @endif
                    </td>
                </tr>
            </table>

            {{-- Section Détails --}}
            <table class="details-table">
                <thead>
                    <tr>
                        <th>DATE DEMANDE</th>
                        <th>DESTINATAIRE</th>
                        <th>EXPEDITEUR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="date-cell">
                            <span>{{ $naissance->created_at->format('d/m/Y') }}</span><br>
                            <span style="font-size:8pt;">{{ $naissance->created_at->format('H:i') }}</span>
                        </td>
                        <td class="dest-cell">
                            <span>Nom & prénoms :{{ $naissance->nom_destinataire ?? $naissance->user->name }} {{ $naissance->prenom_destinataire ?? $naissance->user->prenom }}</span><br>
                            <span>Email :{{ $naissance->email_destinataire ?? $naissance->user->contact }}</span><br>
                            <span>Contact :{{ $naissance->contact_destinataire ?? $naissance->user->contact }}</span><br>
                            <span class="sub-info">Adresse :{{ $naissance->adresse_livraison ?? 'Adresse non spécifiée' }}</span><br>
                            <span class="sub-info">Ville :{{ $naissance->ville ?? 'Ville non spécifiée' }}</span><br>
                            <span class="sub-info">Quartier :{{ $naissance->quartier ?? 'quartier non spécifiée' }}</span><br>
                            <span class="sub-info">Code Postal :{{ $naissance->code_postal ?? 'Code postal non spécifiée' }}</span><br>
                        </td>
                        <td class="exp-cell">
                            <span>Service État Civil</span><br>
                            <span class="sub-info">Mairie de <strong>{{ $naissance->commune ?? 'Ville non spécifiée' }}</strong></span>
                        </td>
                    </tr>
                </tbody>
            </table>

            {{-- Section Référence / Compteur --}}
            <table class="reference-table">
                <tr>
                    <td class="ref-cell">
                        <div style="text-align:center;margin-top:1mm;">
                            @if($naissance->qr_code_path && file_exists(public_path('storage/' . $naissance->qr_code_path)))
                                <img src="{{ public_path('storage/' . $naissance->qr_code_path) }}" class="qr-code-img-ref" alt="QR Ref">
                            @endif
                            <span class="reference-number">{{ $naissance->livraison_code }}</span>
                        </div>
                    </td>
                    <td class="count-cell">
                        <span class="counter-text">1 / 1</span>
                        <span class="destination-text">LIVRAISON À DOMICILE</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>