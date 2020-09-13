<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <p class="m-0 text-center">
                            Korsordshjälpen
                            <a
                                role="button"
                                class="text-warning"
                                data-toggle="popover"
                                data-html="true"
                                data-placement="bottom"
                                title="Om Korsordshjälpen"
                                data-content="
                                Korsordshjälpen är ett verktyg för dig som behöver lite hjälp på traven när det kommer till korsord.
                                För att få förslag på ord skriver du ut dem bokstäver du vet och ersätter dem du ej vet med punkter.
                                <hr>
                                <div class='text-left'>
                                    Exempelvis ger 'hj...a' förslagen:
                                </div>
                                <ul class='m-0 text-left'>
                                    <li>hjälpa</li>
                                    <li>hjärna</li>
                                    <li>hjärta</li>
                                    <li>hjässa</li>
                                </ul>
                                <hr>
                                Ordlistan som används är skapad av Lars Aronsson och innehåller 221 599 ord. Ordlistan kan hittas <a target='_blank' href='http://runeberg.org/words/'>här</a>.
                                ">
                                <i class="fas fa-question-circle"></i>
                            </a>
                        </p>
                    </div>

                    <div class="card-body">
                        <div class="form-group" :class="error ? 'has-danger' : ''">
                            <input v-on:keyup.enter="search" v-model="text" placeholder="Din sökning..." class="form-control" :class="error ? 'form-control-danger' : ''" type="text">
                            <div v-if="error" class="form-control-feedback p-0" style="margin-top: -2px;">
                                <small>
                                    Oj, verkar som det är tomt i fältet.
                                </small>
                            </div>
                        </div>
                        <hr>
                        <div v-if="!loading" class="text-center">
                            <button v-on:click="search" class="btn btn-outline-success col-md-4">Sök</button>
                        </div>
                        <div v-if="loading" class="text-center mt-2">
                            <sync-loader></sync-loader>
                        </div>
                        <div v-if="matches.length">
                            <hr>
                            <p class="m-0 text-center">
                                Sökte efter '<strong>{{ searchText }}</strong>'
                            </p>
                            <p class="m-0 text-center">
                                <small>
                                    Hittade <strong>{{ matches.length }}</strong> matchningar
                                </small>
                            </p>
                            <ul class="m-0">
                                <li v-for="match in matches">
                                    <a target="_blank" :href="'https://www.google.se/search?query=' + match.word">
                                        <small><i class="fab fa-google bg-info p-1 rounded-circle"></i></small>
                                    </a>
                                    {{ match.word }}
                                </li>
                            </ul>
                        </div>
                        <div v-else-if="!matches.length && searched && !loading" class="mt-3">
                            <p class="m-0 text-center">
                                <i class="fas fa-sad-tear"></i>
                                Hittade inga ord som matchade din sökning '<strong>{{ searchText }}</strong>'
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                searched: false,
                searchText: "",
                loading: false,
                text: "",
                error: false,
                matches: []
            }
        },
        methods: {
            search() {
                this.searchText = this.text.trim();
                this.error = this.searchText === "";
                if (this.error) return;
                this.matches = [];
                this.loading = true;
                axios.post('api/search', {
                    text: this.searchText
                }).then(response => {
                    this.matches = response.data;
                }).catch(error => {
                    alert("Looks like you encountered an error, woops!");
                }).then(() => {
                    this.loading = false;
                    this.searched = true;
                })
            }
        }
    }
</script>
