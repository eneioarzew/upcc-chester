<div flex="h" h-end v-center contain="light" fullwidth noshadow>
    <span id="cart-items-count" contain="overlight" nopadding noshadow style="font-weight: bold;"><?php echo $_SESSION["cart_count"]; ?></span>
    <div><?php echo $_SESSION["first_name"] . " " . $_SESSION["last_name"]; ?></div>
    <img src="../<?php echo $_SESSION["dp_path"]; ?>" alt="prof_pic" style="height: 4em; width: 4em; background-color: #F0F0F0; font-size: .7em; border-radius: 50%;">
</div>