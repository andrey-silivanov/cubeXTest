<template>
    <div>
    <vs-row class="table-header">
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="1">
            #ID
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
            Title
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
            Description
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
            Name
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
            Email
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="1">
            File
        </vs-col>
        <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
            Time
        </vs-col>
    </vs-row>
        <vs-row :key="index" v-for="(item, index) in items">
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="1">
                1
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
                Test
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
                Descriptionasdasd asd asd asd as dasd as da d dasd sad asdasd ad asd   as ddasdasdasdasdasd
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
                John
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
                Email@ma.com
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="1">
                true
            </vs-col>
            <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="2">
                121.0.222
            </vs-col>
        </vs-row>
    </div>
</template>
<script type="text/babel">
    export default ({
        data: () => ({
            items: [
                    1, 2, 2,
            ]
        })
    })
</script>

<style scoped>
    .table-header {
        padding-bottom: 10px;
        font-weight: 500;
        border-bottom: 1px solid #eee8d5;
    }
    .vs-row {
        margin: 15px 0;
    }
</style>