<template>

    <Page :Classes = "false" :Animation = "false" >
        <!-- Breadcrumb Start -->
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
                {{ getName('Calendar') }}
            </h2>

            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium cursor-pointer" @click = "this.$router.push('/employees')"> {{getName('employees')}} /</a></li>
                    <li  class=" font-medium text-primary">Calendar</li>
                </ol>
            </nav>
        </div>
        <!-- Breadcrumb End -->

        <Map01 Title="" >

            <FullCalendar
                v-if="info"
                class='demo-app-calendar'
                :options='calendarOptions'
            >
                <template v-slot:eventContent='arg'>
                    <b>{{ arg.timeText }}</b>
                    <i>{{ arg.event.title }}</i>
                </template>

            </FullCalendar>
        </Map01>

    </Page>


</template>


<script>
import { defineComponent } from 'vue'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import { INITIAL_EVENTS, createEventId } from './event-utils'
import Page from "@/components/Layout/Page.vue";
import Map01 from "@/ui-components/Element/map-01.vue";
import {getEmployeeTreatments} from "@/Api.js";
import {createMemoryHistory} from "vue-router";
import {useConterStore} from "@/store/counter.js";
export default defineComponent({
    components: {
        Map01,
        Page,
        FullCalendar,
    },
    data() {
        return {
            info: false,
            calendarOptions: {
                plugins: [
                    dayGridPlugin,
                    timeGridPlugin,
                    interactionPlugin // needed for dateClick
                ],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'dayGridMonth',
                initialEvents: [], // alternatively, use the `events` setting to fetch from a feed
                editable: true,
                selectable: true,
                selectMirror: true,
                dayMaxEvents: true,
                weekends: true,
                select: this.handleDateSelect,
                eventClick: this.handleEventClick,
                eventsSet: this.handleEvents
                /* you can update a remote database when these fire:
                eventAdd:
                eventChange:
                eventRemove:
                */
            },
            currentEvents: [],
        }
    },
    methods: {
        async addTasks() {
            const response = await getEmployeeTreatments(this.$route.query.id);
            console.log('treatL', response.data);
            let treatments = [];
            response.data.forEach((e) => {
                treatments.push({
                    id: e.patient.id,
                    title: e.patient.first_name + ' ' + e.patient.last_name,
                    start: e.start.split(" ")[0],
                    allDay: true ,
                    color:  e.status != 9 ? 'red' : ''
                })
            })



            // Vue.js reaktivligi uchun calendarOptions obyektini yangilash
            this.calendarOptions = {
                ...this.calendarOptions,
                initialEvents: treatments
            };

            console.log('Info:', this.calendarOptions.initialEvents)
            this.info = true;
        },
        getName(val){
            return useConterStore().getName(val)
        },

        handleWeekendsToggle() {
            this.calendarOptions.weekends = !this.calendarOptions.weekends // update a property
        },

        // handleDateSelect(selectInfo) {
        //     console.log('SelectInfo', selectInfo);
        //     let title = prompt('Please enter a new title for your event')
        //     let calendarApi = selectInfo.view.calendar
        //
        //     calendarApi.unselect() // clear date selection
        //     let data = {
        //         id: e.id,
        //         title,
        //         start: selectInfo.startStr,
        //         end: selectInfo.endStr,
        //         allDay: selectInfo.allDay
        //     }
        //     console.log('Data:', data);
        //
        //     if (title) {
        //         calendarApi.addEvent(data)
        //     }
        // },
        handleEventClick(clickInfo) {
            this.$router.push({ path: '/patient/show', query: { id:  clickInfo.event.id } })
            // if (confirm(`Are you sure you want to delete the event '${clickInfo.event.title}'`)) {
            //     clickInfo.event.remove()
            // }
        },
        // handleEvents(events) {
        //     this.currentEvents = events
        // },


    },
    mounted() {
        this.addTasks()
    }
})

</script>


<style lang='css' scoped>

h2 {
    margin: 0;
    font-size: 16px;
}

ul {
    margin: 0;
    padding: 0 0 0 1.5em;
}

li {
    margin: 1.5em 0;
    padding: 0;
}

b { /* used for event dates/times */
    margin-right: 3px;
}

.demo-app {
    display: flex;
    min-height: 100%;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
}

.demo-app-sidebar {
    width: 300px;
    line-height: 1.5;
    background: #eaf9ff;
    border-right: 1px solid #d3e2e8;
}

.demo-app-sidebar-section {
    padding: 2em;
}

.demo-app-main {
    flex-grow: 1;
    padding: 3em;
}

.fc { /* the calendar root */
    max-width: 1100px;
    margin: 0 auto;
}


html,
body,
#app {
    margin: 0;
    padding: 0;
    height: 100%;
}

</style>
