<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Impression de la facture</title>

    <style>
        * {
            font-size: 12px;
            font-family: 'Times New Roman', serif;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .ticket {
            width: 58mm;
            /* Assure-toi que ton imprimante thermique est bien configurée en 58mm */
            max-width: 100%;
            padding: 5px;
            text-align: center;
        }

        .ticket .title {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 5px;
            text-align: center;
        }

        .ticket .heading-text {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            font-size: 12px;
            padding: 2px 0;
            text-align: left;
        }

        td.price,
        th.price {
            text-align: right;
        }

        td.quantity,
        th.quantity {
            text-align: center;
        }

        tr {
            border-top: 1px solid black;
        }

        .centered {
            text-align: center;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }

            .ticket {
                width: 58mm;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="ticket">
        <!-- <img src="./logo.png" alt="Logo"> -->
        <h1 class="title">PRESSING VESTON</h1>

        <span class="heading-text"><strong>Date :</strong> <span><?= date("d/m/Y", strtotime( $_SESSION["invoiceDatas"]["facture"]["created_at"])) ?></span></span>
        <span class="heading-text"><strong>Client :</strong> <span><?= $_SESSION["invoiceDatas"]["client"]["full_name"] ?></span></span>
        <span class="heading-text"><strong>Caissier :</strong> <span><?= $_SESSION["invoiceDatas"]["user"]["username"] ?></span></span>
        <br>

        <table>
            <thead>
                <tr>
                    <th class="description">Description</th>
                    <th class="quantity">QTE.</th>
                    <th class="price">PU</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($_SESSION["invoiceDatas"]["details"] as $detail) : ?>
                <tr>
                    <td class="description"><?= $detail["libelle"] ?></td>
                    <td class="quantity"><?= $detail["qte"] ?></td>
                    <td class="price"><?= $detail["pu"] ?></td>
                </tr>
                <?php endforeach;?>
                
                <tr>
                    <!-- <td class="quantity"></td> -->
                    <td class="description"><strong>TOTAL</strong></td>
                    <td></td>
                    <td class="price"><strong><?= $_SESSION["invoiceDatas"]["facture"]["montant"] ?></strong></td>
                </tr>
            </tbody>
        </table>
        <p class="centered">Merci pour votre confiance!
            <br><strong>GastonDel Pressing</strong>
        </p>
    </div>
    <a href="/pressingapp" class="hidden-print">Retour</a>
    <script>
        document.addEventListener("DOMContentLoaded", function(e){
            window.print();
            
            window.onafterprint = function() {
                window.location.href = "/pressingapp"; 
            };
        })
    </script>
</body>

</html>