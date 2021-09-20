<template>
    <div class="block block-rounded">
        <div class="block-content block-content-full">
            <form method="post">
                <label class="col-form-label" for="name">Nazwa</label>
                <input type="text" v-model="data.name" class="form-control" id="name" style="margin-bottom: 50px">

                <div style="margin-top: 10px" v-for="(input, index) in data.answers">
                    <input type="text" v-model="input.name" class="form-control" :placeholder="input.is_true ? 'Wpisz prawidłową odpowiedź' : 'Wpisz dodatkową odpowiedź'">
                    <span class="cursor" style="font-size: 13px; color: red" v-if="data.answers.length > 2 && !input.is_true" @click="removeAnswer(index)"><i class="fa fa-trash"></i> Usuń odpowiedź </span>
                </div>
                <span class="cursor" @click="addAnswer" style="font-size: 13px;color: #4c78dd;" v-if="data.answers.length < 4"> <i class="fa fa-plus"></i> Kolejna odpowiedź</span>

                <div class="mt-3">
                    <button type="button" @click="save('exit')" class="btn btn-outline-primary btn-sm">Zapisz i przejdź do listy</button>
                    <button type="button" @click="save('next')" class="btn btn-outline-primary btn-sm">Zapisz i dodaj kolejne</button>
                    <a href="" class="btn btn-outline-danger btn-sm">Anuluj</a>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "AdminTestQuestionFormComponent",
    data() {
        return {
            data: {
                name: '',
                answers: [
                    {
                        name: '',
                        is_true: true
                    },
                    {
                        name: '',
                        is_true: false
                    }
                ]
            }
        }
    },
    props: {
        save_url: '',
        type: ''
    },
    methods: {
        addAnswer() {
            this.data.answers.push({
                name: '',
                is_true: false
            })
        },
        removeAnswer(index) {
            this.data.answers.splice(index)
        },
        save(type) {
            this.data.answers = JSON.stringify(this.data.answers);
            this.$axios.post(this.save_url, this.data)
            .then((data) => {
                if (data.data.success === 1) {
                    if (type === 'exit') {
                        return window.location.href = '/administration/trainings/tests/questions'
                    }
                    if (type === 'next') {
                        return window.location.reload();
                    }
                } else {
                    JSON.parse(this.data.answers);
                }
            }).catch((error) => {
                JSON.parse(this.data.answers);
            })
        }
    },

}
</script>

<style scoped>
.cursor:hover{cursor: pointer!important;}
</style>
