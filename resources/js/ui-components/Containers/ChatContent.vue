<template>
    <div class="container-fluid">

        <div class="d-lg-flex h-100">
            <div class="w-100 user-chat h-100">
                <div class="card h-100">
                    <div class="p-4 border-bottom ">
                        <div class="row">
                            <div class="col-md-4 col-9">
                                <h5 class="font-size-15 mb-1">Jarvis</h5>
                                <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Active now</p>
                            </div>
                            <div class="col-md-8 col-3">
                                <ul class="list-inline user-chat-nav text-end mb-0">
                                    <li class="list-inline-item d-none d-sm-inline-block">
                                        <div class="dropdown">
                                            <button @click="this.$router.push('/login')" class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-login"></i>
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div>
                        <div class="chat-conversation p-3">
                            <ul class="list-unstyled mb-0" data-simplebar style="max-height: 486px;">
                                <li>
                                    <div class="chat-day-title">
                                        <span class="title">Today</span>
                                    </div>
                                </li>

                                <slot>

                                </slot>


                            </ul>
                        </div>
                        <div class="p-3 chat-input-section">
                            <div class="row">
                                <div class="col">
                                    <div class="position-relative">
                                        <textarea @input="this.$emit('onInput', $event.target.value)" class="form-control chat-input " placeholder="Enter Message..." ></textarea>
                                        <div class="chat-input-links" id="tooltip-container">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item"><a href="javascript: void(0);" title="Emoji"><i class="mdi mdi-emoticon-happy-outline"></i></a></li>
                                                <li class="list-inline-item"><a href="javascript: void(0);" title="Images"><i class="mdi mdi-file-image-outline"></i></a></li>
                                                <li class="list-inline-item"><a href="javascript: void(0);" title="Add Files"><i class="mdi mdi-file-document-outline"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button @click="this.$emit('onButton', true)" type="submit" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

    </div>
</template>
<script setup>
</script>

<style>
.container-fluid{
    width: 60%;
    height: 100vh;
}

.chat-input{
    border-radius: 10px;
    padding: 15px;
}
</style>
