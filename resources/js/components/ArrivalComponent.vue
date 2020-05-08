<script>
    export default {
        mounted() {
            this.loading = true
            setTimeout(() => this.fetchArrivals(), 1000)
        },
        data(){
            return {
                arrivals: [],
                arrival: {
                    country_id: '',
                    country_from_id: '',
                    year: '',
                    total: '',
                    region: '',
                    value: '',
                    percentage: '',
                },
                arrival_id: '',
                pagination:{},
                edit:false,
                showArrivalForm:false,
            }

        },
        methods: {
            fetchArrivals(page=1){
                axios.get('api/arrivals?page='+page)
                .then( res => {
                    this.arrivals = res.data.data
                    this.pagination = res.data.meta
                    console.log(res.data)
                })
            },
            saveArrival(){
                let formData = {
                    country_id : this.arrival.country_id,
                    country_from_id : this.arrival.country_from_id,
                    year : this.arrival.year,
                    total : this.arrival.total,
                    region : this.arrival.region,
                    value : this.arrival.value,
                    percentage : this.arrival.percentage,
                }

                let method = !this.arrival_id ? 'post' : 'put'
                let url = !this.arrival_id ? `api/arrivals` : `api/arrivals/${this.arrival_id}`

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
                        this.fetchArrivals()

                        this.showArrivalForm = false
                        this.arrival.country_id = ''
                        this.arrival.country_from_id = ''
                        this.arrival.year = ''
                        this.arrival.total = ''
                        this.arrival.region = ''
                        this.arrival.value = ''
                        this.arrival.percentage = ''
                        this.arrival_id = ''
                    }else{
                        alert('Something Went Wrong!!')
                    }
                });

            },

            EditArrival(data){
                this.showArrivalForm = true
                this.arrival_id = data.id
                this.arrival.country_id = data.country_id
                this.arrival.country_from_id = data.country_from_id
                this.arrival.year = data.year
                this.arrival.total = data.total
                this.arrival.region = data.region
                this.arrival.value = data.value
                this.arrival.percentage = data.percentage
            },

            deleteArrival(id) {
                if (confirm('Are You Sure?')) {

                    axios['delete'](`api/arrivals/${id}`)
                    .then(response => {
                        alert('Arrival Removed')
                        this.fetchArrivals()
                    })
                    .catch(err => console.log(err));
                }
            },
            toggoleArrivalForm(){
                this.showArrivalForm = !this.showArrivalForm
            },
            closeArrivalForm(){
                this.showArrivalForm = false
                this.arrival.country_id = ''
                this.arrival.country_from_id = ''
                this.arrival.year = ''
                this.arrival.total = ''
                this.arrival.region = ''
                this.arrival.value = ''
                this.arrival.percentage = ''
                this.arrival_id = ''
            }
        },
    }
</script>
