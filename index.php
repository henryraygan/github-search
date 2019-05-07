<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/master.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>GitHub Search</title>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    
</head>
<body>

    <div id="search">
        <header class="main-header">
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
                <h3 v-if="results.length > 0" class="list-repositories__stats">
                    {{ results_size }} repository results
                </h3>
                <!--stargazers_count-->
                <div v-if="results.length > 0" class="repos">
                    <div v-for="(item, key) in results" :key="key" class="repo">
                        <div class="repo__header">
                            <p class="repo__title">
                                {{item.full_name}}
                            </p>
                            <p class="repo__stars">
                                <i class="fas fa-star"></i>
                                {{kFormatter(item.stargazers_count)}}
                            </p>
                        </div> 
                        <p class="repo__description">
                            {{item.description}}
                        </p>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="vue/main.js"></script>
</body>
</html>