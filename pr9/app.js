const Students = {
    data: function () {
        return {
            newItem: [],
            msg: "",
            students: {},
            groups: {},
        };
    },
    mounted:function(){
        this.getData();
    },
    methods:{
        getData:function(){
            let self = this;
            axios.get("/pr9/index.php/students/getData").then(function(response){
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
                axios.post("/pr9/index.php/students/addStudent", formData).then(function(response){
                    self.getData();
                    self.newItem = [];
                    self.msg="Student added successfully";
                    setTimeout(function(){
                        self.msg="";
                    },5000);
                });
            }
        },
        updateStudent:function(student){
            if(student){
                let self = this;
                let formData = this.toFormData(student);
                formData.append('update',student.id);
                
                axios.post("/pr9/index.php/students/actions", formData).then(function(){
                    self.getData();
                    self.newItem = [];
                    self.msg="Student edited successfully";
                    setTimeout(function(){
                        self.msg="";
                    },5000);
                });
            }
        },
        deleteStudent:function(student){
            if(student){
                let self = this;
                let formData = this.toFormData(student);
                formData = this.toFormData(student);
                formData.append('delete',student.id);
                
                axios.post("/pr9/index.php/students/actions", formData).then(function(){
                    self.getData();
                    self.newItem = [];
                    self.msg="Student deleted successfully";
                    setTimeout(function(){
                        self.msg="";
                    },5000);
                });
            }
        },
    },
    template:`
    <div class="students">
        <form @submit.prevent="addStudent()">
            <div class="msg" v-if="msg">{{msg}}</div>
            <input type="text" v-model="newItem.name" placeholder="Name" required>
            <select v-model="newItem.group_id" v-if="groups">
                <option v-for="g in groups" :value="g.id">{{g.name}}</option>
            </select>
            <input type="submit" value="Add">
        </form>
        <table>
            <tr>
                <th>Name</th>
                <th>Group</th>
                <th>Action</th>
            </tr>
            <tr v-for="s in students">
                <td><input v-model="s.name"></td>
                <td>
                    <select v-model="s.group_id" v-if="groups">
                        <option v-for="g in groups" :value="g.id">{{g.name}}</option>
                    </select>
                </td>
                <td>
                    <button type="submit" @click.prevent="updateStudent(s);">Update</button>
                    <button type="submit" @click.prevent="deleteStudent(s);">Delete</button>
                </td>
            </tr>
        </table>
    </div>
    `,
}

const Subjects = {
    data: function () {
        return {
            newItem: [],
            msg: "",
            subjects: {},
        };
    },
    mounted:function(){
        this.getData();
    },
    methods:{
        getData: function () {
            let self = this;
            axios.get("/pr9/index.php/subjects/getData").then(function (response) {
                if (response.data.subjects) self.subjects = response.data.subjects;
            });
        },
        toFormData: function (obj) {
            let fd = new FormData();
            for (let i in obj) {
                fd.append(i, obj[i]);
            }
            return fd;
        },
        addSubject: function () {
            if (this.newItem) {
                let self = this;
                let formData = this.toFormData(this.newItem);
                axios.post("/pr9/index.php/subjects/addSubject", formData).then(function (response) {
                    self.getData();
                    self.newItem = [];
                    self.msg = "Subject added successfully";
                    setTimeout(function () {
                        self.msg = "";
                    }, 5000);
                });
            }
        },
        updateSubject: function (subject) {
            if (subject) {
                let self = this;
                let formData = this.toFormData(subject);
                formData = this.toFormData(subject);
                formData.append('update', subject.id);

                axios.post("/pr9/index.php/subjects/actions", formData).then(function () {
                    self.getData();
                    self.newItem = [];
                    self.msg = "Subject edited successfully";
                    setTimeout(function () {
                        self.msg = "";
                    }, 5000);
                });
            }
        },
        deleteSubject: function (subject) {
            if (subject) {
                let self = this;
                let formData = this.toFormData(subject);
                formData = this.toFormData(subject);
                formData.append('delete', subject.id);

                axios.post("/pr9/index.php/subjects/actions", formData).then(function () {
                    self.getData();
                    self.newItem = [];
                    self.msg = "Subject deleted successfully";
                    setTimeout(function () {
                        self.msg = "";
                    }, 5000);
                });
            }
        },
    },
    template:`
    <div class="subjects">
        <form @submit.prevent="addSubject()">
            <div class="msg" v-if="msg">{{msg}}</div>
            <input type="text" v-model="newItem.name" placeholder="Name" required>
            <input type="submit" value="Send">
        </form>
        <table>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
            <tr v-for="s in subjects">
                <td><input v-model="s.name"></td>
                <td>
                    <button type="submit" @click.prevent="updateSubject(s);">Update</button>
                    <button type="submit" @click.prevent="deleteSubject(s);">Delete</button>
                </td>
            </tr>
        </table>
    </div>
    `,
}

const Uspishnist = {
    data: function () {
        return {
            newItem: [],
            msg: "",
            uspishnist: {},
            students: {},
            subjects: {}
        };
    },
    mounted:function(){
        this.getData();
    },
    methods:{
        getData: function () {
            let self = this;
            axios.get("/pr9/index.php/uspishnist/getData").then(function (response) {
                console.log(response)
                if (response.data.uspishnist) self.uspishnist = response.data.uspishnist;
                if (response.data.students) self.students = response.data.students;
                if (response.data.subjects) self.subjects = response.data.subjects;
            });
        },
        toFormData: function (obj) {
            let fd = new FormData();
            for (let i in obj) {
                fd.append(i, obj[i]);
            }
            return fd;
        },
        addItem: function () {
            if (this.newItem) {
                let self = this;
                let formData = this.toFormData(this.newItem);
                axios.post("/pr9/index.php/uspishnist/add", formData).then(function (response) {
                    self.getData();
                    self.newItem = [];
                    self.msg = "Item added successfully";
                    setTimeout(function () {
                        self.msg = "";
                    }, 5000);
                });
            }
        },
        updateItem: function (item) {
            if (item) {
                let self = this;
                let formData = this.toFormData(item);
                formData = this.toFormData(item);
                formData.append('update', item.id);

                axios.post("/pr9/index.php/uspishnist/actions", formData).then(function () {
                    self.getData();
                    self.newItem = [];
                    self.msg = "Item edited successfully";
                    setTimeout(function () {
                        self.msg = "";
                    }, 5000);
                });
            }
        },
        deleteItem: function (item) {
            if (item) {
                let self = this;
                let formData = this.toFormData(item);
                formData = this.toFormData(item);
                formData.append('delete', item.id);

                axios.post("/pr9/index.php/uspishnist/actions", formData).then(function () {
                    self.getData();
                    self.newItem = [];
                    self.msg = "Item deleted successfully";
                    setTimeout(function () {
                        self.msg = "";
                    }, 5000);
                });
            }
        },
    },
    template:`
    <div class="uspishnist">
        <form @submit.prevent="addItem()">
            <div class="msg" v-if="msg">{{msg}}</div>
            <select v-model="newItem.sid" v-if="students">
                <option v-for="s in students" :value="s.id">
                    {{s.name}}
                </option>
            </select>
            <br>
            <select v-model="newItem.pid" v-if="subjects">
                <option v-for="s in subjects" :value="s.id">
                    {{s.name}}
                </option>
            </select>
            <input type="number" v-model="newItem.mark" placeholder="Mark" required>
            <input type="submit" value="Send">
        </form>
        <table>
            <tr>
                <th>Name</th>
                <th>Subject</th>
                <th>Mark</th>
                <th>Action</th>
            </tr>
            <tr v-for="u in uspishnist">
                <td>
                    <select v-model="u.sid">
                        <option v-for="s in students" :value="s.id" :selected="u.sid === s.id">
                            {{s.name}}
                        </option>
                    </select>
                </td>
                <td>
                    <select v-model="u.pid">
                        <option v-for="s in subjects" :value="s.id" :selected="u.pid === s.id">
                            {{s.name}}
                        </option>
                    </select>
                </td>
                <td><input type="number" v-model="u.mark"></td>
                <td>
                    <button type="submit" @click.prevent="updateItem(u);">Update</button>
                    <button type="submit" @click.prevent="deleteItem(u);">Delete</button>
                </td>
            </tr>
        </table>
    </div>
    `,
}

const app = new Vue({
    el: "#app",
    router: new VueRouter({
        routes: [
            { path: '/students', component: Students },
            { path: '/subjects', component: Subjects },
            { path: '/uspishnist', component: Uspishnist },
        ]
    }),
    methods: {
        page: function (path) {
            if (this.$route.path !== path) {
                this.$router.replace(path); 
            }
        },
    },
});
