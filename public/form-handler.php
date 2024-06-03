<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function hesapla_tyt($turkce, $matematik, $sosyal, $fen) {
    $tyt_puan = ($turkce * 1.32) + ($matematik * 1.32) + ($sosyal * 1.36) + ($fen * 1.36) + 100; // TYT Temel Puanı 100
    return $tyt_puan;
}

function hesapla_ayt($tyt_puani, $matematik, $fizik, $kimya, $biyoloji, $edebiyat, $tarih, $cografya) {
    $sayisal = ($matematik * 3) + ($fizik * 2.8) + ($kimya * 2.8) + ($biyoloji * 3) + ($tyt_puani * 0.6) + 200;
    $esit_agirlik = ($matematik * 3) + ($edebiyat * 3) + ($tarih * 2.8) + ($cografya * 2.8) + ($tyt_puani * 0.6) + 200;
    return array('sayisal' => $sayisal, 'esit_agirlik' => $esit_agirlik);
}

function tyt_ayt_puan_hesaplama_shortcode() {
    ob_start();
    ?>
    <div class="container mt-5">
        <h1 class="text-center">TYT-AYT Puan Hesaplama Botu</h1>
        <form method="post" class="mt-4">
            <div class="card">
                <div class="card-header">
                    <h2>TYT Netleri</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="turkce">Türkçe:</label>
                        <input type="number" step="0.01" class="form-control" id="turkce" name="turkce" min="0" max="40" required>
                    </div>
                    <div class="form-group">
                        <label for="matematik_tyt">Matematik:</label>
                        <input type="number" step="0.01" class="form-control" id="matematik_tyt" name="matematik_tyt" min="0" max="40" required>
                    </div>
                    <div class="form-group">
                        <label for="sosyal">Sosyal Bilimler:</label>
                        <input type="number" step="0.01" class="form-control" id="sosyal" name="sosyal" min="0" max="20" required>
                    </div>
                    <div class="form-group">
                        <label for="fen">Fen Bilimleri:</label>
                        <input type="number" step="0.01" class="form-control" id="fen" name="fen" min="0" max="20" required>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h2>AYT Netleri</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="matematik_ayt">Matematik:</label>
                        <input type="number" step="0.01" class="form-control" id="matematik_ayt" name="matematik_ayt" min="0" max="40" required>
                    </div>
                    <div class="form-group">
                        <label for="fizik">Fizik:</label>
                        <input type="number" step="0.01" class="form-control" id="fizik" name="fizik" min="0" max="14" required>
                    </div>
                    <div class="form-group">
                        <label for="kimya">Kimya:</label>
                        <input type="number" step="0.01" class="form-control" id="kimya" name="kimya" min="0" max="13" required>
                    </div>
                    <div class="form-group">
                        <label for="biyoloji">Biyoloji:</label>
                        <input type="number" step="0.01" class="form-control" id="biyoloji" name="biyoloji" min="0" max="13" required>
                    </div>
                    <div class="form-group">
                        <label for="edebiyat">Edebiyat:</label>
                        <input type="number" step="0.01" class="form-control" id="edebiyat" name="edebiyat" min="0" max="24" required>
                    </div>
                    <div class="form-group">
                        <label for="tarih">Tarih:</label>
                        <input type="number" step="0.01" class="form-control" id="tarih" name="tarih" min="0" max="10" required>
                    </div>
                    <div class="form-group">
                        <label for="cografya">Coğrafya:</label>
                        <input type="number" step="0.01" class="form-control" id="cografya" name="cografya" min="0" max="6" required>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h2>Puan Türü</h2>
                </div>
                <div class="card-body">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="puan_turu" id="tyt" value="tyt" required>
                        <label class="form-check-label" for="tyt">TYT</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="puan_turu" id="sayisal" value="sayisal" required>
                        <label class="form-check-label" for="sayisal">AYT Sayısal</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="puan_turu" id="esit_agirlik" value="esit_agirlik" required>
                        <label class="form-check-label" for="esit_agirlik">AYT Eşit Ağırlık</label>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Puan Hesapla</button>
            </div>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $turkce = floatval($_POST['turkce']);
            $matematik_tyt = floatval($_POST['matematik_tyt']);
            $sosyal = floatval($_POST['sosyal']);
            $fen = floatval($_POST['fen']);

            $tyt_puani = hesapla_tyt($turkce, $matematik_tyt, $sosyal, $fen);

            $matematik_ayt = floatval($_POST['matematik_ayt']);
            $fizik = floatval($_POST['fizik']);
            $kimya = floatval($_POST['kimya']);
            $biyoloji = floatval($_POST['biyoloji']);
            $edebiyat = floatval($_POST['edebiyat']);
            $tarih = floatval($_POST['tarih']);
            $cografya = floatval($_POST['cografya']);

            $ayt_puanlari = hesapla_ayt($tyt_puani, $matematik_ayt, $fizik, $kimya, $biyoloji, $edebiyat, $tarih, $cografya);

            $puan_turu = $_POST['puan_turu'];
            if ($puan_turu == 'tyt') {
                echo "<div class='alert alert-success mt-4' role='alert'>TYT Puanınız: " . $tyt_puani . "</div>";
            } elseif ($puan_turu == 'sayisal') {
                echo "<div class='alert alert-success mt-4' role='alert'>AYT Sayısal Puanınız: " . $ayt_puanlari['sayisal'] . "</div>";
            } elseif ($puan_turu == 'esit_agirlik') {
                echo "<div class='alert alert-success mt-4' role='alert'>AYT Eşit Ağırlık Puanınız: " . $ayt_puanlari['esit_agirlik'] . "</div>";
            }
        }
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('tyt_ayt_puan_hesaplama', 'tyt_ayt_puan_hesaplama_shortcode');
