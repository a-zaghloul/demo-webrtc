@include('header')
<div class="p-4">

    <h1>Some contents goes here...</h1>


    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <!-- Your content -->
    <button type="button" onclick="logConnectedDevices();" class="relative ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
        Get Devices
    </button>
    <br/><br/>
        <div id="devices-div" class="content-center border-2 border-black border-dashed bg-black text-black p-10">
            <ul id="devices" class="list-disc">
            </ul>
        </div>
    </div>

</div>
@include('footer')
