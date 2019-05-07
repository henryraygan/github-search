<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/master.css">
    <title>GitHub Search</title>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    
</head>
<body>
    <header id="search" class="main-header">
        <div class="container">
            <div class="search-component">
                <div class="search-component__brand">
                    <img src="http://www.logospng.com/images/149/tools-for-information-literacy-welcome-to-inls161-149487.png" alt="GitHub">
                </div>
                <div class="search-box">
                    <input v-model="query" type="text" class="search-box__input">
                    <button v-on:click="search" class="button button-primary search-box__button">
                        {{ button_text }}
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <section class="list-repositories">
            <h3 class="list-repositories__stats">
                530,671 repository results
            </h3>
            <!--stargazers_count-->
            <div class="repos">
                <div class="repo">
                    <div class="repo__header">
                        <p class="repo__title">
                            surmon-china/vue-awesome-swiper
                        </p>
                        <p class="repo__stars">
                            
                        </p>
                    </div>
                    <p class="repo__description">
                        🏆 Swiper component for @vuejs
                    </p>
                </div>
            </div>
        </section>
    </div>
    <script src="vue/main.js"></script>
</body>
</html>