<form id="formestrucfile" name="formestrucfile" action="" method="post">
    <input type="hidden" name="crearestructfile" value="si" />
    <input type="hidden" name="id" value="<?php print $_GET["id"]; ?>" />
    <input type="hidden" id="colfija" value="<?php print $colfija; ?>" />
    <input type="hidden" id="estructura" value="<?php print $estructura ?>" />
    <input type="hidden" id="cargafecha" value="<?php print $cargafecha; ?>" />
    <input type="hidden" id="cargalogal" value="<?php print $cargalocal; ?>" />
    <input type="hidden" id="noreportalocal" value="<?php print $noreportalocal; ?>" />
    <table id="tabla" class="table">
        <tbody>
            <tr style="font-size: 12px;">
                <th style="background-color: #ddd;">Nro Col &nbsp; 
                    <img style="cursor:pointer;" title="Agregar columna" id="plus" src="<?php //print Conectar::Url(); ?>img/icon/b_plus.png" /> &nbsp;
                    <img style="cursor:pointer;" title="Quitar columna" id="minus" src="<?php //print Conectar::Url(); ?>img/icon/b_minus.png" />
                </th>
                <th>Header</th>
                <th>Tipo dato</th>
                <th>Factor de ajuste</th>
                <th>Separador decimal</th>
                <th>Corte decimal</th>
                <th>Longitud</th>
            </tr>
            <?php for ($i = 1; $i < 5; $i++) { ?>
                <tr>
                    <td class="id" style="background-color: #ddd;" >Col <?php print $i; ?></td>
                    <td>
                        <input class="header" type='text' id="header" name="header[]" style="text-transform: uppercase;" />
                    </td>
                    <td>
                        <select id="<?php print $i; ?>" name="tipodato[]" class="tipodato" style="height: 25px;" onchange="ChangeCombo();">
                            <?php// $e->ComboTipoDatos(); ?>
                        </select>
                    </td>
                    <td>
                        <input type='text' id="factor" name="factor[]" size="4" class="desabilitar" />
                    </td>
                    <td>
                        <select id="separador" name="separador[]" style="height: 25px;" class="desabilitar">
                            <option value="0">NO APLICA</option>
                            <option value="1">. [PUNTO]</option>
                            <option value="2">, [COMA]</option>
                        </select>
                    </td>
                    <td>
                        <input type='text' id="cortedec" name="cortedec[]" size="4" class="desabilitarcorte"  />
                    </td>
                    <td>
                        <input type='text' id="longitud" name="longitud[]" size="4" class="desabilitarlonfija"  />
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</form>
<p class="clear"><button id="btncrearestructura" style="cursor: pointer;"><img alt="" src="<?php echo Conectar::Url(); ?>img/icon/b_save.png" /> Crear estructura de archivo</button></p