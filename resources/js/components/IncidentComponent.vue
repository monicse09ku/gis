<script>
    export default {
        mounted() {
            this.loading = true
            setTimeout(() => this.fetchIncidents(), 1000)
        },
        data(){
            return {
                incidents: [],
                incident: {
                    region: '',
                    year: '',
                    month: '',
                    number_of_death: '',
                    minimum_estimated_number_of_missing: '',
                    total_dead_and_missing: '',
                    number_of_survivors: '',
                    cause_of_death: '',
                    location_description: '',
                    latitude: '',
                    longitude: '',
                },
                incident_id: '',
                pagination:{},
                edit:false,
                showIncidentForm:false,
            }

        },
        methods: {
            fetchIncidents(page=1){
                axios.get('api/incidents?page='+page)
                .then( res => {
                    this.incidents = res.data.data
                    this.pagination = res.data.meta
                    console.log(res.data)
                })
            },
            saveIncident(){
                let formData = {
                    region : this.incident.region,
                    year : this.incident.year,
                    month : this.incident.month,
                    number_of_death : this.incident.number_of_death,
                    minimum_estimated_number_of_missing : this.incident.minimum_estimated_number_of_missing,
                    total_dead_and_missing : this.incident.total_dead_and_missing,
                    number_of_survivors : this.incident.number_of_survivors,
                    cause_of_death : this.incident.cause_of_death,
                    location_description : this.incident.location_description,
                    latitude : this.incident.latitude,
                    longitude : this.incident.longitude,
                }

                let method = !this.incident_id ? 'post' : 'put'
                let url = !this.incident_id ? `api/incidents` : `api/incidents/${this.incident_id}`

                axios({
                  method: method,
                  url: url,
                  data: formData,
                  validateStatus: (status) => {
                    return true; // I'm always returning true, you may want to do it depending on the status received
                  },
                }).catch(error => {
                    alert('Something Went Wrong')
                }).then(response => {
                    if(response.status === 200){
                        alert('Success')
                        this.fetchIncidents()

                        this.showIncidentForm = false
                        this.incident.region = ''
                        this.incident.year = ''
                        this.incident.month = ''
                        this.incident.number_of_death = ''
                        this.incident.minimum_estimated_number_of_missing = ''
                        this.incident.total_dead_and_missing = ''
                        this.incident.number_of_survivors = ''
                        this.incident.cause_of_death = ''
                        this.incident.location_description = ''
                        this.incident.latitude = ''
                        this.incident.longitude = ''
                        this.incident_id = ''
                    }else{
                        alert('Something Went Wrong!!')
                    }
                });

            },

            EditIncident(data){
                this.showIncidentForm = true
                this.incident_id = data.id
                this.incident.region = data.region
                this.incident.year = data.year
                this.incident.month = data.month
                this.incident.number_of_death = data.number_of_death
                this.incident.minimum_estimated_number_of_missing = data.minimum_estimated_number_of_missing
                this.incident.total_dead_and_missing = data.total_dead_and_missing
                this.incident.number_of_survivors = data.number_of_survivors
                this.incident.cause_of_death = data.cause_of_death
                this.incident.location_description = data.location_description
                this.incident.latitude = data.latitude
                this.incident.longitude = data.longitude
            },

            deleteIncident(id) {
                if (confirm('Are You Sure?')) {

                    axios['delete'](`api/incidents/${id}`)
                    .then(response => {
                        alert('Incident Removed')
                        this.fetchIncidents()
                    })
                    .catch(err => console.log(err));
                }
            },
            toggoleIncidentForm(){
                this.showIncidentForm = !this.showIncidentForm
            },
            closeIncidentForm(){
                this.showIncidentForm = false
                this.incident.region = ''
                this.incident.year = ''
                this.incident.month = ''
                this.incident.number_of_death = ''
                this.incident.minimum_estimated_number_of_missing = ''
                this.incident.total_dead_and_missing = ''
                this.incident.number_of_survivors = ''
                this.incident.cause_of_death = ''
                this.incident.location_description = ''
                this.incident.latitude = ''
                this.incident.longitude = ''
                this.incident_id = ''
            }
        },
    }
</script>
