<table style="width: 100%">
    <tr>
        <td style="width: 50%;text-align: center;">
            <strong>Entrante</strong>
        </td>
    </tr>
    <tr>
        <td style="font-size: 14px;line-height: 22px;text-align: center;">
            <?php echo $guarnicio['normal']['Plat']?>
            <br>
            <?php echo ( $guarnicio['regimen']['Plat'] != $guarnicio['normal']['Plat'] ) ? $guarnicio['regimen']['Plat'] : ''?>
        </td>
    </tr>
</table>

<table style="width: 50%">
    <tr>
        <td style="width: 50%;text-align: center;">
            <strong>Primero</strong>
        </td>
    </tr>
    <tr>
        <td style="font-size: 14px;line-height: 22px;text-align: center;">
            <?php echo $primer['normal']['Plat']?>
            <br>
            <?php echo ( $primer['regimen']['Plat'] != $primer['normal']['Plat'] ) ? $primer['regimen']['Plat'] : ''?>
        </td>
    </tr>
</table>

<table style="width: 50%">
    <tr>
        <td  style="width: 50%;text-align: center;">
            <strong>Segundo</strong>
        </td>
    </tr>
    <tr>
        <td style="font-size: 14px;line-height: 22px;text-align: center;">
            <?php echo $segon['normal']['Plat']?>
            <br>
            <?php echo ( $segon['regimen']['Plat'] != $segon['normal']['Plat'] ) ? $segon['regimen']['Plat'] : ''?>
        </td>
    </tr>
</table>

<table style="width: 100%">
    <tr>
        <td style="width: 50%;text-align: center;">
            <strong>Postre</strong>
        </td>
    </tr>
    <tr>
        <td style="font-size: 14px;line-height: 22px;text-align: center">
            <?php echo $postre['normal']['Plat']?>
            <br>
            <?php echo ( $postre['regimen']['Plat'] != $postre['normal']['Plat'] ) ? $postre['regimen']['Plat'] : ''?>
        </td>
    </tr>
</table>



