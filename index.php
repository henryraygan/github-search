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
                        <button 
                            v-on:click="search" 
                            class="button button-primary search-box__button"
                            :disabled="this.query.length < 3">
                            {{ button_text }}
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <div class="container">
            <div v-if="isSearch" class="is-search">
                <img src="https://github.githubassets.com/images/spinners/octocat-spinner-64.gif" alt="">
                <p>
                    Search repositories
                </p>
            </div>
            <section class="list-repositories">
                <h3 v-if="results.length > 0" class="list-repositories__stats">
                    {{ formatNumber(results_size) }} repository results
                </h3>
                <div v-if="results.length > 0" class="repos">
                    <div 
                        v-for="(item, key) in results" 
                        :key="key" 
                        class="repo">
                        <div class="repo__header">
                            <p v-on:click="openModal(item)" class="repo__title">
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
                    <modal v-if="showModal" @close="showModal = false">
                        <div slot="body">
                            <div class="repo-modal-header">
                                <h2 class="repo-modal-title">
                                 {{ modal_info.name }}
                                </h2>
                                <p class="repo-modal-fullname">
                                {{ modal_info.description }}
                                </p>
                            </div>
                            <div class="author">
                                <table>
                                    <tr>
                                        <td class="author-key">Author</td>
                                        <td class="author-info">
                                            <img class="author-img" :src="modal_info.owner.avatar_url" :alt="modal_info.owner.login">
                                            {{modal_info.owner.login}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="author-key">Full name</td>
                                        <td class="author-info">{{modal_info.full_name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="author-key">Created</td>
                                        <td class="author-info">
                                            {{ dateFormatter(modal_info.created_at) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="author-key">License</td>
                                        <td class="author-info">
                                            <span v-if="modal_info.license !== null">
                                                {{ modal_info.license.name }}
                                            </span>
                                            <span v-else>
                                                There is no information about the license
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="author-key">Clone</td>
                                        <td class="author-info">
                                            <span>
                                                git clone {{ modal_info.clone_url }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                                <div class="panel-commits">
                                    <ul class="list-commits">
                                        <li 
                                            v-for="(item, key) in recents_commits" 
                                            :key="key">
                                            {{ item.message }}
                                            <br>
                                            <span class="committed">
                                                
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </modal>
                </div>
            </section>

            <button v-if="results.length > 0"  @click="loadMore" class="button button-more">
                More
            </button>

        </div>
    </div>

    <script type="text/x-template" id="modal-template">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">
                        <div class="modal-footer">
                            <slot name="footer">
                                <button class="modal-default-button" @click="$emit('close')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </slot>
                        </div>
                        <div class="modal-body">
                            <slot name="body">
                                default body
                            </slot>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </script>
    <script src="vue/main.js"></script>
</body>
</html>