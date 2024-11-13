<script src="vue.min.js"></script>
 
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<script src="js/jquery-3.7.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<img alt="Progi logo" src="assets/logo.png" />
<div id="myApp">
    <div class="container">
        <h1 class="text-center">BID</h1>
        <p v-if="errors.length">
            <b>Please correct the following error(s):</b>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
        </p>
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <form method="POST" action="create.php" v-on:submit.prevent="doCalculate">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" ref="price" class="form-control" />
                    </div>
 
                    <div class="form-group">
                        <label for="vehicule_type">Vehicule Type</label>
                        <select class="form-control" name="vehicule_type">
                            <option value="1">COMMON</option>
                            <option value="2">LUXURY</option>
                        </select>
                    </div>

                    <input type="submit" value="Calculate" class="btn btn-primary" />
                </form>
            </div>
        </div>

        <table class="table">
            <tr>
                <th>Vehicule Price ($)</th>
                <th>Vehicule Type</th>
                <th>Basic</th>
                <th>Special</th>
                <th>Association</th>
                <th>Storage</th>
                <th>Total ($)</th>
            </tr>
        
            <tr v-for="(bid, index) in bids">
                <td v-text="bid.price"></td>
                <td v-text="bid.vehicule_type"></td>
                <td v-text="bid.basic_buyer_free"></td>
                <td v-text="bid.seller_special_fee"></td>
                <td v-text="bid.association_fee"></td>
                <td v-text="bid.storage_fee"></td>
                <td v-text="bid.total_price"></td>
            </tr>
        </table>
    </div>
</div>


<script>
    // initialize Vue JS    
    const myApp = new Vue({
        el: "#myApp",
        data: {
            bids: [],
            errors: []
        },
        methods: {
            // get all bids from database
            getData: function () {
                const self = this;
            
                const ajax = new XMLHttpRequest();
                ajax.open("POST", "read.php", true);
            
                ajax.onreadystatechange = function () {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            const bids = JSON.parse(this.responseText);
                            self.bids = bids;
                        }
                    }
                };
            
                const formData = new FormData();
                ajax.send(formData);
            },
            doCalculate: function () {
                const self = this;
                const form = event.target;
                
                this.errors = [];

                if(this.$refs.price.value == ""){
                    this.errors.push('Price required.');
                    return false;
                }

                if(isNaN(this.$refs.price.value)){
                    this.errors.push('Price should be a number.');
                    return false;
                }

                const ajax = new XMLHttpRequest();
                ajax.open("POST", form.getAttribute("action"), true);
 
                ajax.onreadystatechange = function () {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            console.log(this.responseText);
                        }
                    }
                };
 
                const formData = new FormData(form);
                ajax.send(formData);
                this.getData();
                this.$refs.price.value='';
            }
        },

        // call an AJAX to fetch data when Vue JS is mounted
        mounted: function () {
            this.getData();
        }
    });
</script>