            <?
            $i=0;
            if (is_array($data)) {
                foreach ($data as $data) {
                    $i++;
                    ?>
                        <option><?php $data[id]; ?><?= htmlentities($data[nama]) ?></option>
                <?
                }
            } else {
                echo "<option> Data Kosong </option>";
            }
            ?>
