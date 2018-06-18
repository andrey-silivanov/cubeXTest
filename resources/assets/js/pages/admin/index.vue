<template>
    <div class="page-wrapper">
        <navBar/>
        <vs-row class="full-height">
            <vs-col class="full-height" vs-offset="2" vs-type="flex" vs-justify="center"
                    vs-align="center" vs-w="8">
                <div class="form-wrapper">
                    <div class="centerx">
                        <vs-card vs-color="rgb(30, 199, 135)">
                            <vs-card-header vs-background-color="rgb(30, 199, 135)" vs-title="A nice title"
                                            vs-subtitle="A nice subtitle" vs-icon="account_circle"></vs-card-header>
                            <vs-card-body>
                                <my-table></my-table>
                                <vs-row>
                                    <vs-col class="full-height" vs-offset="2" vs-type="flex" vs-justify="center"
                                            vs-align="center" vs-w="8">
                                        <vs-pagination :vs-total="5" :vs-current="2" vs-type="filled"></vs-pagination>
                                   </vs-col>
                                </vs-row>
                            </vs-card-body>
                        </vs-card>
                    </div>
                </div>
            </vs-col>
        </vs-row>

    </div>
</template>
<script type="text/babel">
    import navBar from './../../components/navbar.vue';
    import myTable from './table'

    export default ({
        components: {
            navBar,
            myTable
        }
    })
</script>