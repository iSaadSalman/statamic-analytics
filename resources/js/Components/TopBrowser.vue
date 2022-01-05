<template>
    <div class="card p-0">
        <h3 class="p-2">By Browser</h3>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Browser</th>
                    <th class="text-right">Visitors</th>
                </tr>
            </thead>
            <tbody>
                <tr class="outline-none" v-for="(item, index) in items" :key="index">
                    <td class="text-sm break-all">{{ item.browser }}</td>
                    <td class="text-right">{{ item.visitors }}</td>
                </tr>
            </tbody>

        </table>
        <div class="text-center text-sm text-gray-100 my-1" v-if="items.length == 0">No Data</div>
    </div>
</template>

<script>
export default {
    props: {
        period: {
            type: String,
            required: true
        }
    },

    watch: {
        $props: {
            handler() {
                this.fetch()
            },
            deep: true,
            immediate: true
        }
    },

    data() {
        return {
            error: null,
            items: []
        }
    },

    mounted() {
        this.fetch()
    },

    methods: {
        async fetch() {
            await fetch(`/manage/statamic-analytics/api/top-browsers?period=${this.period}`)
                .then(res => res.json())
                .then(res => this.items = res)
                .catch(err => console.log(err))
        }
    }
}
</script>
