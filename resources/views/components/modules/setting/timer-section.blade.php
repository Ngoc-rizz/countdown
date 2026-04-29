 <div class="p-8">
     <div class="flex items-center gap-3 mb-2">
         <div class="p-2 bg-orange-100 text-orange-600 rounded-lg">
             <i data-lucide="clock" class="w-5 h-5"></i>
         </div>
         <span class="text-gray-700 font-bold uppercase tracking-wider">Timer</span>
     </div>

     <x-ui.divider />

     <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
         <x-ui.setting-row label="Focus" name="pomodoro" unit="min" />
         <x-ui.setting-row label="Break" name="break_time" unit="min" />
     </div>
 </div>
