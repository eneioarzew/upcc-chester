<?php
session_start();
if (!isset($_SESSION["type"]) || $_SESSION["type"] !== "ADMIN") header("Location: ../error/403");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("views/shared/headers.php"); ?>
    <style>
        #message-box {
            display: none;
            opacity: 0;
            transition: opacity .15s;
        }
    </style>
    <title>New Product Type | UPCC Admin</title>
</head>

<body back-light>
    <div flex="h">
        <?php include_once("views/shared/admin_nav.php"); ?>
        <div flex="v" fullwidth nogap>
            <div main>
                <div flex="h" v-center>
                    <button onclick="history.back()" contain="secondary" small button flex="h" v-center style="height: fit-content; width: fit-content; border-radius: var(--border-radius);"><img src="../views/assets/img/arrow-right.webp" style="transform: rotate(180deg);" alt=""></button>
                    <h1>New Product Type</h1>
                </div>
                <form flex="v" onsubmit="submitProductType(); return false;">
                    <div id="message-box" bordered fullwidth dark-text dark-text-all></div>
                    <div form-group>
                        <div flex="h" v-center>
                            <h3 nomargin>Name</h3>
                            <i style="color: red;">*Required</i>
                        </div>
                        <input type="text" id="name" form-input placeholder="Enter name here" required>
                    </div>
                    <div form-group>
                        <h3 nomargin>Description</h3>
                        <textarea id="description" form-input placeholder="Enter description here" rows="10"></textarea>
                    </div>
                    <div flex="h" h-end>
                        <button type="submit" contain="good" button>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div contain="dark" fullwidth sharp-edges>
        <div id="copyright" style="text-align: right; color: #aaa; font-size: 0.8em;">
            Copyright © 2022 | All rights reserved.
        </div>
    </div>
    <script>
        function submitProductType() {
            const FORM = document.querySelector("form");
            const NAME = document.querySelector("input#name");
            const DESCRIPTION = document.querySelector("textarea#description");
            const MESSAGE_BOX = document.querySelector("#message-box");
            let inputs = {
                "name": NAME.value,
                "description": DESCRIPTION.value,
            };

            fetch("../api/create-product-type", {
                "method": "POST",
                "Content-Type": "application/json; charset=UTF-8",
                "body": JSON.stringify(inputs),
            }).then(response => response.text()).then(data => {
                try {
                    data = JSON.parse(data);
                } catch (error) {
                    console.error(error);
                    return;
                }

                if (data["status"] !== 200) {
                    MESSAGE_BOX.setAttribute("contain", "danger");
                    MESSAGE_BOX.innerText = data["message"];
                    fadeInOut(MESSAGE_BOX);
                    return;
                }

                MESSAGE_BOX.setAttribute("contain", "good");
                MESSAGE_BOX.innerHTML = `Product type <i>"${inputs["name"]}"</i> created successfully`;
                fadeInOut(MESSAGE_BOX);
                FORM.reset();
            });
        }
    </script>
</body>

</html>