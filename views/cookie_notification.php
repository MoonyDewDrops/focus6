<style>
        .cookie-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 15px;
            z-index: 1000;
        }
        .cookie-banner button {
            margin: 0 10px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
</style>
    <div class="cookie-banner">
        <p>Wij gebruiken cookies voor onze websit. Ga je akkoord met onze cookies?</p>
        <button onclick="acceptCookies()">Ja</button>
        <button onclick="declineCookies()">Nee</button>
    </div>

    <script>
        function acceptCookies() {
            document.cookie = "cookie_agreement=1; path=/; max-age=" + (60 * 60 * 24 * 365);
            location.reload();
        }

        function declineCookies() {
            alert("Je moet het eens zijn met onze cookies om onze website te gebruiken en bezoeken.");
            window.location.href = "https://www.google.com"; 
        }
    </script>
