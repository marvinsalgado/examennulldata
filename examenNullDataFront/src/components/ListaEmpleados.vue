<template>

  <table class="table">
    <thead>
    <tr>
        <th><abbr title="name">Nombre</abbr></th>
        <th><abbr title="email">Email</abbr></th>
        <th><abbr title="position">Puesto</abbr></th>
        <th><abbr title="birthdate">Fecha de Nacimiento</abbr></th>
        <th><abbr title="address">Domicilio</abbr></th>
        <th><abbr title="skills">Skills</abbr></th>
        <th><abbr title="acciones">Acciones</abbr></th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="employee of employees">
        <th>{{employee.name}}</th>
        <th>{{employee.email}}</th>
        <th>{{employee.position}}</th>
        <th>{{employee.birthdate}}</th>
        <th>{{employee.address}}</th>
        <th>{{employee.employees_skils.map(function (item){
          return item.nameSkill;
        })}}</th>
        <td>
            <button @click="goingToVerEmployee(employee.id)">Ver</button>
        </td>
    </tr>
    </tbody>
  </table>



</template>



<script>
import axios from 'axios';
import { useRouter } from 'vue-router'
export default {
    // Properties returned from data() become reactive state
    // and will be exposed on `this`.
    data() {
        return {
            employees: null,
            employee: null

        }
    },

    // Methods are functions that mutate state and trigger updates.
    // They can be bound as event handlers in templates.
    methods: {

        goingToVerEmployee(id){
            //useRouter.push({ path: '/employee'})
            console.log(id);
        }

    },

    // Lifecycle hooks are called at different stages
    // of a component's lifecycle.
    // This function will be called when the component is mounted.
    mounted() {
        axios.get('http://localhost:8000/api/employees').then(response => (this.employees = response.data))
        console.log(this.employees);
    }
}
</script>
