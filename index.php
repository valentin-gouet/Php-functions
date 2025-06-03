<?php
// 1. Créez une fonction PHP nommée "calculateDiscount" qui prend deux
// paramètres : le prix original d'un article et un taux de remise (exprimé en
// pourcentage).
// 2. Dans la fonction, calculez le montant de la remise en multipliant le prix
// original par le taux de remise (exprimé en entier ou en décimal).
// 3. Soustrayez le montant de la remise du prix original pour obtenir le prix
// remisé.
// 4. Retournez le prix remisé sous la forme d'une chaîne de caractères
// formatée, y compris le symbole monétaire de votre choix (par exemple,
// "19,99 €").

// 5. Créez un formulaire qui permet à l'utilisateur de saisir le prix original et le
// taux de remise. Utilisez la fonction $_POST pour récupérer les entrées de
// l'utilisateur et appelez la fonction "calculateDiscount" pour afficher le prix
// remisé.
function calculateDiscount(int|float $price, int|float $discount): string
{
    if ($price > 0 && $discount > 0) {
        // $discountPrice = number_format($price * (1 - ($discount / 100)), 2, ",", " ");
        $discountAmount = $price * ($discount / 100);
        $discountPrice = $price - $discountAmount;
        return "$discountPrice € <br><br>";
    }
    return number_format($price, 2, ",", " ");
}
$message = "";
if (isset($_POST["price"]) && isset($_POST["discount"])) {
    $price = $_POST["price"];
    $discount = $_POST["discount"];
    $message = calculateDiscount($price, $discount);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- <form action="" method="post">
        <label for="price">Prix :</label>
        <input name="price" id="price" type="number"><br>
        <label for="discount">Montant de la remise :</label>
        <input name="discount" id="discount" type="number"><br>
        <input type="submit">
    </form> -->
    <?php if(isset($message)) {
        echo $message;} ?>

<?php
    function convertCurrency(int|float $moneyAmount, string $toCurrency):string|null
    {
        if( $toCurrency == "EUR"){
            return $moneyAmount / 1.08 . "€";
        }
        elseif($toCurrency == "USD"){
            return $moneyAmount * 1.08 . "$";
        }
        return "";
    }
    // echo convertCurrency(100, "USD");
    // echo convertCurrency(150, "EUR");
    $convertedAmount = "";
    if(isset($_GET["amount"]) && isset($_GET["currency"])) {
        $convertedAmount = convertCurrency($_GET["amount"], $_GET["currency"]);
    }
?>
    <form action="" method="GET">
        <label for="amount">Montant :</label>
        <input name="amount" id="amount" type="number" step="0.01"><br>
        <label for="currency">Devise :</label>
        <select name="currency" id="currency">
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
        </select><br>
        <button type="submit">Convertir</button>
    </form>
    <?php echo $convertedAmount; ?>
</body>
</html>