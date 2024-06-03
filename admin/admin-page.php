<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function tyt_ayt_puan_hesaplama_admin_page() {
    ?>
    <div class="wrap">
        <h1>TYT-AYT Puan Hesaplama</h1>
        <form method="post" action="">
            <h2>TYT Netleri</h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="turkce">Türkçe:</label></th>
                    <td><input name="turkce" type="number" step="0.01" id="turkce" value="" class="regular-text" min="0" max="40" required></td>
                </tr>
                <tr>
                    <th scope="row"><label for="matematik_tyt">Matematik:</label></th>
                    <td><input name="matematik_tyt" type="number" step="0.01" id="matematik_tyt" value="" class="regular-text" min="0" max="40" required></td>
                </tr>
                <tr>
                    <th scope="row"><label for="sosyal">Sosyal Bilimler:</label></th>
                    <td><input name="sosyal" type="number" step="0.01" id="sosyal" value="" class="regular-text" min="0" max="20" required></td>
                </tr>
                <tr>
                    <th scope="row"><label for="fen">Fen Bilimleri:</label></th>
                    <td><input name="fen" type="number" step="0.01" id="fen" value="" class="regular-text" min="0" max="20" required></td>
                </tr>
            </table>

            <h2>AYT Netleri</h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="matematik_ayt">Matematik:</label></th>
                    <td><input name="matematik_ayt" type="number" step="0.01" id="matematik_ayt" value="" class="regular-text" min="0" max="40" required></td>
                </tr>
                <tr>
                    <th scope="row"><label for="fizik">Fizik:</label></th>
                    <td><input name="fizik" type="number" step="0.01" id="fizik" value="" class="regular-text" min="0" max="14" required></td>
                </tr>
                <tr>
                    <th scope="row"><label for="kimya">Kimya:</label></th>
                    <td><input name="kimya" type="number" step="0.01" id="kimya" value="" class="regular-text" min="0" max="13" required></td>
                </tr>
                <tr>
                    <th scope="row"><label for="biyoloji">Biyoloji:</label></th>
                    <td><input name="biyoloji" type="number" step="0.01" id="biyoloji" value="" class="regular-text" min="0" max="13" required></td>
                </tr>
                <tr>
                    <th scope="row"><label for="edebiyat">Edebiyat:</label></th>
                    <td><input name="edebiyat" type="number" step="0.01" id="edebiyat" value="" class="regular-text" min="0" max="24" required></td>
                </tr>
                <tr>
                    <th scope="row"><label for="tarih">Tarih:</label></th>
                    <td><input name="tarih" type="number" step="0.01" id="tarih" value="" class="regular-text" min="0" max="10" required></td>
                </tr>
                <tr>
                    <th scope="row"><label for="cografya">Coğrafya:</label></th>
                    <td><input name="cografya" type="number" step="0.01" id="cografya" value="" class="regular-text" min="0" max="6" required></td>
                </tr>
            </table>

            <h2>Puan Türü</h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="puan_turu">Puan Türü:</label></th>
                    <td>
                        <fieldset>
                            <label><input type="radio" name="puan_turu" value="tyt" required> TYT</label><br>
                            <label><input type="radio" name="puan_turu" value="sayisal" required> AYT Sayısal</label><br>
                            <label><input type="radio" name="puan_turu" value="esit_agirlik" required> AYT Eşit Ağırlık</label>
                        </fieldset>
                    </td>
                </tr>
            </table>

            <?php submit_button('Puan Hesapla'); ?>
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
                echo "<div class='updated notice'><p>TYT Puanınız: " . $tyt_puani . "</p></div>";
            } elseif ($puan_turu == 'sayisal') {
                echo "<div class='updated notice'><p>AYT Sayısal Puanınız: " . $ayt_puanlari['sayisal'] . "</p></div>";
            } elseif ($puan_turu == 'esit_agirlik') {
                echo "<div class='updated notice'><p>AYT Eşit Ağırlık Puanınız: " . $ayt_puanlari['esit_agirlik'] . "</p></div>";
            }
        }
        ?>
    </div>
    <?php
}
