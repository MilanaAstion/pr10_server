<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
        <nav>
        <a href="/">Students</a>
        <a href="/index.php/subjects">Predmeti</a>
        <a href="/index.php/uspishnist">Uspishnist</a>
    </nav>
    <br>
    <hr>
     <div id="app">
        <form @submit.prevent="addStudent()">
            <div class="msg" v-if="msg">{{msg}}</div>
            <input type="text" v-model="newItem.name" placeholder="Name" required /><br>
            <select v-model="newItem.group_id" v-if="groups">
                <option v-for="g in groups" :value="g.id">{{ g.name }}</option>
            </select>
            <br>
            <input type="submit" value="Отправить" />
        </form>
        <table>
                <tr>
                    <th>Имя</th>
                    <th>Группа</th>
                    <th>Обновить</th>
                    <th>Удалить</th>
                </tr>
            <tbody>
                <tr v-for="s in students">
                    <td><input type="text" v-model="s.name"></td>
                    <td>
                        <select v-model="s.group_id" v-if="groups">
                            <option v-for="g in groups"  :value="g.id">{{ g.name }}</option>
                        </select>
                    </td>
                    <td><button type="submit"  @click.prevent="updateStudent(s);">Update</button></td>
                    <td><button type="button" @click.prevent="deleteStudent(s);">Delete</button></td>
                </tr>
        </table>
     </div>
    <script>
        new Vue({
            el: '#app', 
            data: {
                newItem: [],
                msg: "",
                students: {}, 
                groups: {}   
            },
            mounted:function() {
                this.getData(); 
            },
            methods: {
                getData:function() {
                    let self = this;
                    axios.get('/index.php/students/getData').then(function(response){
                            if(response.data.students) self.students = response.data.students;
                            if(response.data.groups) self.groups = response.data.groups;
                    });
                },
                toFormData:function(obj){
                    let fd = new FormData();
                    for(let i in obj){
                        fd.append(i, obj[i]);
                    }
                    return fd;
                },
                addStudent:function(){
                    if(this.newItem){
                        let self = this;
                        let formData = this.toFormData(this.newItem);
                        axios.post("/index.php/students/addStudent", formData).then(function(response){
                            self.getData();
                            self.newItem = [];
                            self.msg = "Студент успешно добавлен";
                            setTimeout(function(){
                                self.msg = "";
                            },1000);
                        })
                    }
                },
                updateStudent:function(student){
                    if(student){
                        let self = this;
                        let formData = this.toFormData(student);
                        formData.append('update', student.id);

                        axios.post("/index.php/students/actions", formData).then(function(){
                            self.getData();
                            self.newItem = [];
                            self.msg="Студент успешно изменен";
                            setTimeout(function(){
                                self.msg="";
                            },1000);
                        });
                    }
                },
                deleteStudent:function(student){
                    if(student){
                        let self = this;
                        let formData = this.toFormData(student);
                        formData.append('delete', student.id);

                        axios.post("/index.php/students/actions", formData).then(function(){
                            self.getData();
                            self.newItem = [];
                            self.msg="Студент успешно удален";
                            setTimeout(function(){
                                self.msg="";
                            },1000);
                        });
                    }
                }
            }
        });
    </script>
</body>
</html>