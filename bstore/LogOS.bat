@echo off
title Log O/S Basic Input/Output System
setlocal EnableDelayedExpansion
set "PATH=%PATH%;%cd%\bin_os;"
set "tab=	"
if exist boot_os\boot_config.settings goto prepare_bootmenu
:internal_start
call :normalstuffs
del temp_os\*.* /q
set key=^^!ERRORLEVEL^^!
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if "%hibernated%"=="true" cls
:reask
if not exist log_os md log_os
if exist config_os\Screen.settings for /f "eol=: delims=," %%a in (config_os\Screen.settings) do set %%a
if exist config_os\Policies.settings for /f "eol=: delims=," %%a in (config_os\Policies.settings) do set %%a
if "%screen_w%"=="" set screen_w=150
if "%screen_h%"=="" set screen_h=45
call :hibercheck
set "blankspace="
set "minispace="
set "tinyspace="
set /a space_w=!screen_w!/2-4
set /a minispace_w=!screen_w!/2-10
set /a tinyspace_w=!screen_w!/2-22
set /a blank_h=!screen_h!/2-4
for /l %%a in (1 1 !space_w!) do set "blankspace=!blankspace! "
for /l %%a in (1 1 !minispace_w!) do set "minispace=!minispace! "
for /l %%a in (1 1 !tinyspace_w!) do set "tinyspace=!tinyspace! "
if "%updatecheck%"=="true" goto passit
if exist boot_os\systeminitialize del boot_os\systeminitialize&goto efiprocess
title Please wait...
goto EFI
::      The following lines are used to make sure that update process
::      is functional in older versions. Do not remove these lines
::      to ensure that user settings and LogOS itself won't get
::		corrupted.
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
goto :flagsult
:EFI
if exist boot_os\bootscreen0.cmd set stagar=true
if exist factorial set stagar=true
if "%setup%"=="true" goto logos
reg add "HKCU\Software\Microsoft\Command Processor" /v DefaultColor /t REG_DWORD /d 15 /f >nul
if exist skiptoskamp del skiptoskamp&goto skamp
if "%stagar%"=="true" color 0F
if "%stagar%"=="true" goto skamp
if not exist log_os md log_os
if not exist log_os\lgr @echo.>>log_os\lgr
if not "%sos%"=="true" title Please wait.
if "%sos%"=="true" title EFI preparing...
if exist factorial del factorial&goto inputmethods
if exist performanceboot goto inputmethods
bg _kbd
set key=%errorlevel%
if "%key%"=="402" call :wcall&@echo.>>bootfresh
if "%key%"=="338" title ...&echo Would you like to enter BIOS setup? If so, follow these steps:&echo.&echo.&echo Keep holding DEL...&goto inputmethods
if "%key%"=="334" @echo.>>force&goto inputmethods
if "%key%"=="321" del log_os\Shutdown
if "%key%"=="320" @echo.>>crash
if "%key%"=="318" @echo.hibernated=true,>>config_os\%OSname%.settings&@echo.restore=welcome,>>config_os\%OSname%.settings&start /b "" %0&title Please wait..&@echo.>>boot_os\systeminitialize&@echo.>>log_os\terminate&exit
:efiprocess
ping localhost -n 1 >nul
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
color 07
ping localhost -n 1 >nul
color 08
ping localhost -n 1 >nul
if not "%stagar%"=="true" mode %screen_w%,%screen_h%
if not "%stagar%"=="true" mode %screen_w%,%screen_h%
cls
for /l %%a in (1 1 %blank_h%) do (
Echo.%blankspace%               
)
Echo.%blankspace%³    
Echo.%blankspace%³    
Echo.%blankspace%³ù    
Echo.%blankspace%³ùù   
Echo.%blankspace%ÀÄÄÄÄÄ
Echo.
Echo.%minispace%LogOS technologies
if "%hibernated%"=="true" title Loading hibernation data...
if "%hibernated%"=="true" color %rndcolor%
if "%bootloader%"=="" set bootloader=true
if "%recover%"=="" set recover=false
if "%debug%"=="true" Echo. Debug mode
if not "%hibernated%"=="true" ping localhost -n 1 >nul
if not "%hibernated%"=="true" color 07
if not "%hibernated%"=="true" ping localhost -n 1 >nul
if not "%hibernated%"=="true" color 0F
if not "%hibernated%"=="true" ping localhost -n 1 >nul
if not exist config_os goto firstuse_g
if not exist bin_os goto mainbinerror
if "%hibernated%"=="true" goto inin
:inputmethods
if not "%stagar%"=="true" ping localhost -n 1 >nul
if not "%stagar%"=="true" color 07
if not "%stagar%"=="true" ping localhost -n 1 >nul
if not "%stagar%"=="true" color 0F
if not "%stagar%"=="true" ping localhost -n 1 >nul
if not exist config_os goto firstuse_g
:inin
if exist performanceboot set constart=true&goto skamp
bg _kbd
set key=%errorlevel%
if "%key%"=="27" set setup=true&goto bootoption
set stagar=true
:skamp
if exist firstboot goto autosetup
if "%sos%"=="true" title Checking if logos logo exists
if not exist boot_os\logos_logo.bat call :createboot
if not "%fullscreen%"=="true" set "cmdwidth=50"
if "%fbootloader%"=="true" set fbootloader=false&goto recoveryerror
if "%bootloader%"=="true" goto logos
if "%sos%"=="true" title Preparing sound driver...
title Please wait..
:firstart
if not exist config_os\%OSname%.settings title Initial startup. Please wait...
if not exist config_os\%OSname%.settings goto wud3
if not "%now%"=="true" for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if exist bin_os\bg.exe bg cursor 0
prompt Emergency prompt: %ERRORLEVEL%$F
if "%console%"=="true" goto startupcommand
if "%sos%"=="true" title Preparing bootloader
set bootloader=true
set recover=false
goto skamp
title Please wait..
goto :passit

:oopsieerror
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Check if apps_os folder has been renamed or deleted
Echo. - Reinstall system software
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback.html
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E051 - System applications not found
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
if not exist log_os md log_os
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E051 - System applications not found>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look


:mainbinerror
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Check if bin_os folder has been renamed or deleted
Echo. - Reinstall system firmware
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback.html
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E000 - Binaries not found in specified directory
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
if not exist log_os md log_os
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E000 - Binaries not found in specified directory>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
:loop
if exist bin_os goto reask
goto look

:flashit
title 0%%
call :passit&title 1%% ^|
set preversion=%version%
cls
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo.
Echo.
Echo.
Echo Explore the new possiblities of 2.9:
Echo.
Echo Enhanced variable management, true hibernation, new login screen, new commands
Echo new boot logo and animation and much more. All of that while keeping the
Echo compatiblity with the older versions of Log OS.
set hash=%random%&md backup%hash%&title 3%% /
copy %0 "backup%hash%"
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<-                               ^>
ping localhost -n 1 >nul
:flagsult
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<--                              ^>
ping localhost -n 1 >nul
call :passit&title 10%% \
cls
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<---                             ^>
ping localhost -n 1 >nul
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<----                            ^>
ping localhost -n 1 >nul
if exist logos_settings_backup.cmd del logos_settings_backup.cmd >nul
if exist log_os\log.txt del log_os\log.txt >nul
if exist log_os\LogOS_is_running del log_os\LogOS_is_running >nul
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop >nul
if exist log_user\Settings_are_here del log_user\Settings_are_here >nul&title 25%% /
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<-----                           ^>
ping localhost -n 1 >nul
@echo.>>log_os\Shutdown&title 27%% --
set backup=logos_settings_backup.cmd
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<------                          ^>
ping localhost -n 1 >nul
title 30%% \
color 07
for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
echo ::WARNING!>>backups\%backup%
echo ::>>backups\%backup%
echo ::To avoid errors in Log OS, please don't edit this file>>backups\%backup%
echo ::Saved at : N 18.09.2014 17:51:51.01>>backups\%backup%
@echo userg=%userg%,>>backups\%backup%
::This line is used to verify amount of lines in this batch file while installing system package. DO NO REMOVE THIS OR ANY OTHER LINE!
@echo ip=%ip%,>>backups\%backup%
@echo rndcolor=%rndcolor%,>>backups\%backup%
@echo adminpass=%adminpass%,>>backups\%backup%
@echo pp=%pp%,>>backups\%backup%
@echo userdescription=%userdescription%,>>backups\%backup%
@echo hibernated=%hibernated%,>>backups\%backup%
@echo restore=%restore%,>>backups\%backup%
@echo usercolor=%usercolor%,>>backups\%backup%
@echo admincol=%admincol%,>>backups\%backup%&title 40%% ^|
@echo logoncolor=%logoncolor%,>>backups\%backup%
@echo guestcolor=%guestcolor%,>>backups\%backup%
@echo factory=%factory%,>>backups\%backup%
@echo noguest=%noguest%,>>backups\%backup%
@echo autoreset=%autoreset%,>>backups\%backup%
@echo adno=%adno%,>>backups\%backup%
@echo adname=%adname%,>>backups\%backup%
@echo admindescript=%admindescript%,>>backups\%backup%
@echo classic=%classic%,>>backups\%backup%
@echo fullscreen=%fullscreen%,>>backups\%backup%
@echo autologon=%autologon%,>>backups\%backup%
@echo loginname=%loginname%,>>backups\%backup%
@echo nopass=%nopass%,>>backups\%backup%
@echo noupass=%noupass%,>>backups\%backup%
@echo compatibility=%compatibility%,>>backups\%backup%
@echo domain=%domain%,>>backups\%backup%
@echo resolution=%resolution%,>>backups\%backup%
@echo constart=%constart%,>>backups\%backup%&title 50%% /
@echo sounded=%sounded%,>>backups\%backup%
if not exist backups\%backup% goto back2ue
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<-------                         ^>
ping localhost -n 1 >nul
@echo.@echo off>>flasher.bat
@echo.:flashing>>flasher.bat
@echo.color F0>>flasher.bat
@echo.if exist "%destination%\LogOS.bat" copy "%destination%\LogOS.bat" "%cd%" >nul>>flasher.bat
@echo.color 07,>>flasher.bat
@echo.fi=yes,>>flasher.bat
@echo.start /b LogOS.bat>>flasher.bat
@echo.exit>>flasher.bat
start /b flasher.bat&exit
:fi
set fi=no
title 55%% --
title Welcome %user%to LogOS recovery mode
set load=logos_settings_backup.cmd
if not exist backups\%load% goto res2u2e
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<--------                        ^>
ping localhost -n 1 >nul
if exist backups\%load% call backups\%load%&title 60%% \
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<---------                       ^>
ping localhost -n 1 >nul
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
ping localhost -n 1 >nul
echo ::WARNING!>>config_os\%OSname%.settings
ping localhost -n 1 >nul
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
echo.:>>config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<----------                      ^>
ping localhost -n 1 >nul
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<-----------                     ^>
ping localhost -n 1 >nul

bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<------------                    ^>
ping localhost -n 1 >nul
@echo ip=%ip%,>> config_os\%OSname%.settings&title 65%% ^|
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<-------------                   ^>
ping localhost -n 1 >nul
if "%rndcolor%"=="" set rndcolor=07
@echo rndcolor=%rndcolor%,>> config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<--------------                  ^>
ping localhost -n 1 >nul
if "%adminpass%"=="" set adminpass=administratorhasmanyrights
if "%oldstart%"=="" set oldstart=false
@echo adminpass=%adminpass%,>>config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<---------------                 ^>
ping localhost -n 1 >nul

bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<----------------                ^>
ping localhost -n 1 >nul

bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<-----------------               ^>
ping localhost -n 1 >nul
if "%hibernated%"=="" set hibernated=false
@echo hibernated=%hibernated%,>>config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<------------------              ^>
ping localhost -n 1 >nul
@echo restore=%restore%,>>config_os\%OSname%.settings&title 70%% /
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<-------------------             ^>
ping localhost -n 1 >nul
if "%usercolor%"=="" set usercolor=07

bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<--------------------            ^>
ping localhost -n 1 >nul
if "%admincol%"=="" set admincol=07
@echo admincol=%admincol%,>>config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<---------------------           ^>
ping localhost -n 1 >nul
if "%logoncolor%"=="" set logoncolor=07
@echo logoncolor=%logoncolor%,>>config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<----------------------          ^>
ping localhost -n 1 >nul
if "%guestcolor%"=="" set guestcolor=07
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings
if "%factory%"=="" set factory=no
@echo factory=no,>> config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<-----------------------         ^>
ping localhost -n 1 >nul
if "%noguest%"=="" set noguest=false
@echo noguest=%noguest%,>> config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<------------------------        ^>
ping localhost -n 1 >nul
if "%autoreset%"=="" set autoreset=true
@echo autoreset=%autoreset%,>>config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<-------------------------       ^>
ping localhost -n 1 >nul
if "%adno%"=="" set adno=false
@echo adno=%adno%,>>config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<--------------------------      ^>
ping localhost -n 1 >nul
if "%adname%"=="" set adname=Administrator
@echo adname=%adname%,>>config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<---------------------------     ^>
ping localhost -n 1 >nul
@echo admindescript=%admindescript%,>>config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<----------------------------    ^>
ping localhost -n 1 >nul
if "%classic%"=="" set classic=false
@echo classic=%classic%,>>config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<-----------------------------   ^>
ping localhost -n 1 >nul
if "%autologon%"=="" set autologon=false
@echo autologon=%autologon%,>>config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<------------------------------  ^>
ping localhost -n 1 >nul
@echo loginname=%loginname%,>>config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<------------------------------  ^>
ping localhost -n 1 >nul
if "%nopass%"=="" set nopass=no
@echo nopass=%nopass%,>>config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<------------------------------  ^>
ping localhost -n 1 >nul
if "%noupass%"=="" set noupass=false&title 75%% --
@echo noupass=%noupass%,>>config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<------------------------------- ^>
ping localhost -n 1 >nul
if "%compatibility%"=="" set compatibility=no
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<------------------------------- ^>
ping localhost -n 1 >nul
if "%compat%"=="" set compat=no
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<------------------------------- ^>
ping localhost -n 1 >nul
if "%resolution%"=="" SET resolution=seven
::@echo resolution=%resolution%,>>config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<------------------------------- ^>
ping localhost -n 1 >nul
if "%constart%"=="" set constart=false
@echo constart=%constart%,>>config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<--------------------------------^>
ping localhost -n 1 >nul
if "%sounded%"=="" set sounded=true
@echo sounded=%sounded%,>>config_os\%OSname%.settings
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<--------------------------------^>
ping localhost -n 1 >nul
color 07
if not exist config_os\%OSname%.settings goto res2i2e
bin_os\bg.exe locate 0 0
Echo. Upgrading...
Echo.  Please do not cancel this proccess...
Echo. ^<--------------------------------^>
ping localhost -n 1 >nul
if exist flasher.bat del flasher.bat
if exist backup%hash% rd "%cd%\backup%hash%" /s /q
if exist backup%hash% rd backup%hash%
set updatecheck=true
call :passit
set updatecheck=&title 90%% /
set bootloader=
title 95%% --
cls
Echo. Just a sec...
@echo.>>log_os\terminate
if exist boot_os\Sound.bat goto skipservicesetup
ping localhost -n 1 >nul
copy "%destination%\boot_os\Sound.bat" "%cd%" /Y >NUL
ping localhost -n 1 >nul
:skipservicesetup
if "%flashresult%"=="goodtogo" set bootloader=&set finishflash=true&goto finishflash
if "%flashresult%"=="" goto error40202015
Echo. Something happened, retry flash...
goto flashit

:finishflash
title 100%%
bin_os\bg.exe locate 0 0
Echo. Just a sec...
Echo.  Upgrading drivers and bootloader...
Echo.  Do not turn off the Log OS system
if exist logos_bootloader.bat del logos_bootloader.bat
if exist boot_os\logos_logo.bat del boot_os\logos_logo.bat
if exist boot_os\Sound.bat del boot_os\Sound.bat
mode %screen_w%,%screen_h%
cls
Echo.
Echo Upgrade was successful.
Echo.
Echo Previous version: %preversion%
Echo New version: %version%
Echo.
Echo Log OS will restart in 20 seconds...
ping localhost -n 2 >nul
start /b "" %0
exit
:checkall
if not exist bootfresh goto logos
del bootfresh
call :wcall
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
if exist boot_os\Sound.bat del boot_os\Sound.bat
if exist boot_os\logos_logo.bat del boot_os\logos_logo.bat
if exist log_os\log.txt del log_os\log.txt
@echo.>>factorial
goto autosetup
:failflash
cls
Echo.
Echo. Flashing has been cancelled
Echo.
Pause>nul
goto firstart

:check_key
if not exist force goto logos
del force
Echo Log OS update recovery
Echo Please send command in command.cmd
:loop
if exist command.cmd call command.cmd
if not "%destination%"=="" goto flashit
goto loop

::LogOS main code
:logos
if exist log_os\log.txt goto errorfound
if "%skiplogos%"=="true" set constart=true
if "%recover%"=="" goto EFI
if "%autorun%"=="" set autorun=
if "%setup%"=="true" ping localhost -n 2 >nul&color 07&ping localhost -n 1 >nul&color 08&ping localhost -n 1 >nul&cls&color 0F&goto tempset
call :passit
if exist performanceboot set fullscreen=true&goto preparenow
bg _kbd
set key=%errorlevel%
if "%key%"=="402" goto checkall
if "%key%"=="338" title wait... Please&echo.&echo Release DEL key now...&@echo.>>succeed_key&goto pause_rec
if "%key%"=="334" goto check_key
@echo.>>log_os\terminate
set compat1=true
if exist boot_os\bootscreen0.cmd goto preparenow
set fullscreen=true
:preparenow
if "%constart%"=="true" set skiplogos=true
set OSname=LogOS
set ld=%cd%
set "path="
set live=false
path=%ld%;%systemroot%\System32
if "%hibernated%"=="false" goto fin12
@echo.>>hiberstore
:fin12
if exist bin_os\bg.exe bg font %res%
if "%restart%"=="false" set restart=&goto start
if "%now%"=="true" goto setup
if "%sos%"=="true" title OUTPUT
::Files are loaded
:skipdetectfull
:bootg
:nul10
if "%compatibility%"=="yes" call :compatmode
if "%compat%"=="yes" goto prepareing
:prepareing
if exist boot_os\Sound.bat del boot_os\Sound.bat
if not exist config_os\%OSname%.settings set autoreset=true
if "%sos%"=="true" title Checking if DISKINFO.COM exist
if "%compat%"=="yes" goto ssssssssssssss
:ssssssssssssss
if "%sos%"=="true" title Setting few variables
set gp32=true
if "%sos%"=="true" title Turning echo off
@echo off
if "%sos%"=="true" title Setting startup variables
set randomm=%random%
set starttime=%time%
set answer5=Your selection:
if "%sos%"=="true" title Deleting any pointless logs
if exist Preparing_kernel del Preparing_kernel
if "%sos%"=="true" title Creating the pointless log
Echo Preparing file. Just Pointless>>Preparing
if "%sos%"=="true" title Output
:startup53
if "%sos%"=="true" title Saving %OSname% log
Echo LogOSmessages >> log_os\LogOS_is_running
title Please wait...
if "%sos%"=="true" title Setting pointless variables
set n=%nothing%
set nothing=%f1%
if "%sos%"=="true" title Loading userdata
if "%sos%"=="true" title If userdata doesn't exist, setting some variablesv
if "%compat%"=="yes" goto setstartupmode
if "%sos%"=="true" title Checking for important system files
if "%constart%"=="true" set compat2=true&set slogo=no&set compat=true
:setstartupmode
if "%sos%"=="true" title Resizing window...
if "%sos%"=="true" title Clearing screen
if "%sos%"=="true" title Setting color to 0F
bg _kbd
set key=%errorlevel%
if "%key%"=="27" set setup=true&goto bootoption
if "%sos%"=="true" title Deleting pointless log
if exist Preparing del Preparing
if "%sos%"=="true" title Checking if recovery command is enabled
if "%recover%"=="" goto recoveryerror
if %recover% EQU true goto sfrec
if "%conboot%"=="" set conboot=false
if %conboot% EQU true goto safemode
if "%sos%"=="true" title Checking if fullscreen if enabled
if exist boot_os\bootscreen0.cmd goto really23
if "%fullscreen%"=="true" goto activatefscreen
:really23
if "%sos%"=="true" title Setting reason
set reason=R_key
if "%sos%"=="true" title Output
if exist log_os\firstuse set factory=yes
if "%factory%"=="yes" goto lololololololololol2455
if "%recoveryaccess%"=="no" goto lololololololololol2455
if "%now%"=="sklm" set now=true&goto sldkd
bg cursor 0
goto lololololololololol2455

:firstusesettings
if exist specific_os\root @echo.>log_os\Shutdown&goto logon
if "%adname%"=="" set adname=Administrator
if "%admincol%"=="" set admincol=07
if "%usercolor%"=="" set usercolor=07
if "%guestcolor%"=="" set guestcolor=07
if "%admindescript%"=="" set "admindescript=User who manages the computer"
if "%adminpass%"=="" set "adminpass=administratorhasmanyrights"
if "%userg%"=="" set "userg=%username%"
if "%userdescription%"=="" set "userdescription=Your personal user account"
if not exist specific_user md specific_user
md specific_user\%adname%
md specific_user\%adname%\picture
md specific_user\%adname%\audio
md specific_user\%adname%\video
md specific_user\%adname%\document
md specific_user\%userg%
md specific_user\%userg%\picture
md specific_user\%userg%\audio
md specific_user\%userg%\video
md specific_user\%userg%\document
md specific_user\Guest
md specific_user\Guest\picture
md specific_user\Guest\audio
md specific_user\Guest\video
md specific_user\Guest\document
if not exist specific_os md specific_os
md specific_os\root
md specific_os\root\picture
md specific_os\root\audio
md specific_os\root\video
md specific_os\root\document
md specific_os\share
md specific_os\share\picture
md specific_os\share\audio
md specific_os\share\video
md specific_os\share\document
if not exist config_user md config_user
@echo.::WARNING^^!>config_user\%adname%.settings
@echo.::>>config_user\%adname%.settings
@echo.::To avoid errors in Log OS, please don't edit this file>>config_user\%adname%.settings
@echo.::>>config_user\%adname%.settings
@echo.::Saved at : %date% %time%>>config_user\%adname%.settings
@echo.adname=%adname%,>>config_user\%adname%.settings
@echo.admincol=%admincol%,>>config_user\%adname%.settings
@echo.adminpass=%adminpass%,>>config_user\%adname%.settings
@echo.admindescript=%admindescript%,>>config_user\%adname%.settings
@echo.type=Administrator,>>config_user\%adname%.settings

@echo.::WARNING^^!>config_user\%userg%.settings
@echo.::>>config_user\%userg%.settings
@echo.::To avoid errors in Log OS, please don't edit this file>>config_user\%userg%.settings
@echo.::>>config_user\%userg%.settings
@echo.::Saved at : %date% %time%>>config_user\%userg%.settings
@echo.userg=%userg%,>>config_user\%userg%.settings
@echo.usercolor=%usercolor%,>>config_user\%userg%.settings
@echo.pp=%pp%,>>config_user\%userg%.settings
@echo.userdescription=%userdescription%,>>config_user\%userg%.settings
@echo.type=User,>>config_user\%userg%.settings
if not exist log_user md log_user
if not exist temp_os md temp_os
exit /b

:lololololololololol2455
if "%factory%"=="yes" call :firstusesettings
if "%customize%"=="no" goto sldkd
if "%constart%"=="true" goto sldkd
if exist boot_os\bootscreen0.cmd goto skipthatshit
:skipthatshit
set "tab=	"
for /l %%a in (1,1,1000) do set "bck=!bck!"
if exist boot_os\bootscreen0.cmd call boot_os\bootscreen0.cmd&goto sldkd
call :passit
title Please wait..
if "%finishflash%"=="true" Echo.&goto resumesfosss
if "%hibernated%"=="true" Echo.&goto sldkd
:sldkd
if "%sos%"=="true" title If userdata doesn't exist, creating some
if not exist config_os\%OSname%.settings set noguest=false
if not exist config_os\%OSname%.settings set t=0
if not exist config_os\%OSname%.settings set hibernated=false
if not exist config_os\%OSname%.settings set factory=true
if not exist config_os\%OSname%.settings set adminpass=administratorhasmanyrights
if not exist config_os\%OSname%.settings goto choice1
bg _kbd
set key=%errorlevel%
if "%key%"=="27" set setup=true&goto bootoption
if "%sos%"=="true" title Checking for bad shutdown
if "%hibernated%"=="true" goto notchoice
:choice1
call :wcall
setlocal EnableDelayedExpansion
set "tab=	"
set key=^^!ERRORLEVEL^^!
for /l %%a in (1,1,1000) do set "bck=!bck!"
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if not "%fullscreen%"=="true" set "cmdwidth=50"
if exist Scanning_for_errors del Scanning_for_errors&goto shutdownerrors
if exist log_user\Settings_are_here del log_user\Settings_are_here&goto shutdownerrors
if exist Loading_administrator_things del Loading_administrator_things&goto shutdownerrors
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop&goto shutdownerrors
if exist log_os\Logonscreen del log_os\Logonscreen&goto shutdownerrors
if exist temp.txt del temp.txt&goto shutdownerrors
if exist log_os\LogOS_is_running goto shutdownerrors
if exist log_os\log.txt goto shutdownerrors
:choice2
if "%loginname%"=="" set hoting=true
if "%hoting%"=="true" goto hidescreen1
if "%hibernated%"=="true" goto hidescreen1
if exist hiberstore goto hidescreen1
if exist boot_os\bootscreen0.cmd goto hidescreen1
bin_os\bg.exe locate 0 0
for /l %%a in (1 1 %blank_h%) do (
Echo.%blankspace%               
)
Echo.%blankspace%      ³     
Echo.%minispace%³     
Echo.%minispace%     ³      ù    
Echo.%minispace%   ³     ùù   
Echo.%minispace%  À  Ä  Ä  Ä  Ä   Ä
Echo.%blankspace%               
Echo.%minispace% Starting LogOS...                                  
if "%hibernated%"=="true" Echo.%minispace%   Resuming..&set constart=true
:hidescreen1
if "%hibernated%"=="true" set constart=false
if "%sos%"=="true" title Deleting logs
if exist log_os\log.txt del log_os\log.txt
if exist Scanning_for_errors del Scanning_for_errors
if exist log_user\Settings_are_here del log_user\Settings_are_here
if exist Loading_administrator_things del Loading_administrator_things
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_os\Logonscreen del log_os\Logonscreen
bg _kbd
set key=%errorlevel%
if "%key%"=="27" set setup=true&goto bootoption
if exist temp.txt del temp.txt
if exist save del save
if not exist config_os\%OSname%.settings set "Center="Creating user data" & Call:CenterText Center strLen
if "%logoncolor%"=="" set logoncolor=07
if "%admincol%"=="" set admincol=07
if "%guestcolor%"=="" set guestcolor=07
if "%usercolor%"=="" set usercolor=07
if "%adname%"=="" set adname=Administrator
if "%an%"=="" set /a an=%nothing%+1
if "%gn%"=="" set /a gn=%nothing%+2
if "%adno%"=="" set adno=false
if "%classic%"=="" set classic=false
if "%fullscreen%"=="" set fullscreen=false
if exist crazygame.cmd Echo This shows you have played crazygame >> save
if "%sos%"=="true" title Checking for first use second step
if "%customize%"=="no" goto snfsfsfnrffsf
if exist log_os\firstuse del log_os\firstuse&set factory=yes&del log_os\Shutdown&goto snfsfsfnrffsf
if "%sos%"=="true" title Checking for first boot
if exist log_os\freshboot del log_os\freshboot&set log_os\freshboot=yes&goto snfsfsfnrffsf
if "%sos%"=="true" title OUTPUT

:snfsfsfnrffsf
if "%sos%"=="true" title Checking for user input
if not "%live%"=="true" @echo. Startup cancelled>>log_os\log.txt
if "%now%"=="true" title Welcome %user%to LogOS&goto logon
if exist firstboot goto a28
if not exist config_os\%OSname%.settings goto a28
if exist boot_os\bootscreen0.cmd goto a28
:choicenow
if exist log_os\Shutdown goto sfosss
:resumesfosss
goto a28

:sfosss
if "%customize%"=="no" goto a28
if exist log_os\Shutdown del log_os\Shutdown
Echo.
set startinglogos=yes
goto resumesfosss

:usepinginstead
goto :eof

:shutdownerrors
if "%now%"=="true" goto choice1
if "%sos%"=="true" title Checking if unusual shutdown is normal
if exist log_os\freshboot goto choice2&Echo Booting LogOS for first time...
if exist log_os\Shutdown goto choice2&Echo Booting LogOS...
if "%sos%"=="true" title Saving pointless log
Echo scanningerrors >> Scanning_for_errors
if "%sos%"=="true" title Output
if "%sos%"=="true" title Checking for errors
if exist log_os\log.txt goto errorfound
if "%sos%"=="true" title Setting variable
bg _kbd
set key=%errorlevel%
if "%key%"=="27" set setup=true&goto bootoption
cls
call boot_os\LogOS_logo.bat
echo.
echo. Advanced startup menu
color 0f
echo.
Echo Warning: Unexcepted shutdown
if "%sos%"=="true" title Deleting pointless log
if exist Scanning_for_errors del Scanning_for_errors
if "%sos%"=="true" title Output
echo.
echo This may be caused because of a corrupted system or settings file. If
echo this was due to system shutting down to protect data, you can choose
echo one of the options below. Otherwise, you can try starting Log OS normally.
echo.
set "sel=5"
set "expand=15"
goto loopersafe

:errorfound
cls
call boot_os\LogOS_logo.bat
echo.
echo. Advanced startup menu
color F0
echo.
Echo Warning: Unexcepted shutdown
set /a expand=15
if "%sos%"=="true" title Deleting pointless log
if exist Scanning_for_errors del Scanning_for_errors
if "%sos%"=="true" title Output
if "%sos%"=="true" title Typing log
for /f "delims=" %%a in ('type log_os\log.txt') do (
echo %%a
set /a expand+=1
)
del log_os\log.txt
if "%sos%"=="true" title Save error check...
echo.
echo This may be caused because of a corrupted system or settings file. If
echo this was due to system shutting down to protect data, you can choose
echo one of the options below. Otherwise, you can try starting Log OS normally.
echo.
ping localhost -n 1 >nul
set "sel=1"
goto loopersafe
:loopersafe
set "timeout=true"
if exist log_os\log.txt goto errorfound
if exist log_os\Shutdown del log_os\Shutdown&set "key="&goto a28
:loopiesafe
title Advanced startup options
bin_os\bg.exe locate !expand! 0
if "!sel!"=="1" bin_os\bg.exe print 9f " > Automatically try to repair the settings file      \n"
if not "!sel!"=="1" echo.   Automatically try to repair the settings file      
if "!sel!"=="2" bin_os\bg.exe print 9f " > Recovery mode/Manual repair                        \n"
if not "!sel!"=="2" echo.   Recovery mode/Manual repair                        
if "!sel!"=="3" bin_os\bg.exe print 9f " > Safe mode (safe command environment)               \n"
if not "!sel!"=="3" echo.   Safe mode (safe command environment)               
if "!sel!"=="4" bin_os\bg.exe print 9f " > Reload cache (may fix some issues)                 \n"
if not "!sel!"=="4" echo.   Reload cache (may fix some issues)                 
echo.
if "!sel!"=="5" bin_os\bg.exe print 9f " > Continue loading Log OS normally                   \n"
if not "!sel!"=="5" echo.   Continue loading Log OS normally                   
if "!sel!"=="6" bin_os\bg.exe print 9f " > Restart system                                     \n"
if not "!sel!"=="6" echo.   Restart system                                     
echo.
set /a timelocx=45
set /a timelocy=!expand!+8
if "%timeout%"=="false" (
echo. Use up and down arrow keys to change selection and
echo. enter to confirm selection.
) else (
echo. Selected option will automatically start in 5     
echo. seconds.                   
)
:tryagainsafe
if not "%timeout%"=="false" (
	for /l %%a in (1 1 50) do (
		bg sleep 100
		bg _kbd
		set key=!ERRORLEVEL!
		if not "!key!"=="0" goto yupsafe
		bin_os\bg.exe locate !timelocy! !timelocx!
		set temp=%%a
		set /a ea=!temp!/10
		set /a rem=5-!ea!
		echo !rem!
	)
	if "%key%"=="0" goto :anssafe
) else (
	bin_os\bg.exe kbd
)
:yupsafe
set timeout=false
set a=%ERRORLEVEL%
set last=%sel%
if "%a%"=="335" set /a sel+=1
if "%a%"=="327" set /a sel-=1
if "%a%"=="13" goto :anssafe
if "!sel!"=="0" set sel=1
if "!sel!"=="7" set sel=6
if not "!sel!"=="!last!" set timeout=false
goto loopiesafe

:anssafe
if "!sel!"=="6" goto restart
if "!sel!"=="5" set "key="&cls&echo Starting %OSname%, please wait...&goto a28
if "!sel!"=="4" call :wcall&for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a&set sel=5&goto loopersafe
if "!sel!"=="3" goto safemode
if "!sel!"=="2" goto sfrec
if "!sel!"=="1" goto refresherrors
goto a28

:fixerrors
Echo. Checking for save errors...
bg cursor 0
if "%sos%"=="true" title Performing write test
@echo.>>Test_write.txt
if "%sos%"=="true" title Checking for Test_write.txt
if not exist Test_write.txt goto makec
if "%sos%"=="true" title Found, deleting it...
del Test_write.txt
if "%sos%"=="true" title Wiping cache...
SET userg=
SET n=
SET ip=
SET rndcolor=
SET adminpass=
SET answer5=
SET pw=
SET pp=
SET userdescription=
set hibernated=
set restore=
set usercolor=
set admincol=
set logoncolor=
set guestcolor=
SET factory=
SET noguest=
SET autoreset=
SET adno=
SET an=
SET gn=
SET adname=
SET admindescript=
SET classic=
SET fullscreen=
SET autologon=
SET loginname=
SET nopass=
SET noupass=
SET now=
SET domain=
SET oldstart=
if "%sos%"=="true" title Loading settings
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if "%sos%"=="true" title Checking if error is temporary
if "%autologon%"=="" goto refresherrors
if "%classic%"=="" goto refresherrors
if "%hibernated%"=="" goto refresherrors
if "%factory%"=="" goto refresherrors
Echo. No errors found
ping localhost -n 2 >nul
goto logostemporary
:refresherrors
if "%sos%"=="true" title Loading settings
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if "%sos%"=="true" title Deleting settings
del config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Saving date)
echo ::WARNING!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
::
if "%sos%"=="true" title Performing system refresh... (Saving user)

if "%sos%"=="true" title Performing system refresh... (Saving ip)
@echo ip=%ip%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Checking common color)
if "%rndcolor%"=="" set rndcolor=07
if "%sos%"=="true" title Performing system refresh... (Saving common color)
@echo rndcolor=%rndcolor%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Checking admin pass)
if "%adminpass%"=="" set adminpass=administratorhasmanyrights
if "%sos%"=="true" title Performing system refresh... (Saving admin pass)
@echo adminpass=%adminpass%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Saving plugins)

if "%sos%"=="true" title Performing system refresh... (Saving user pass)

if "%sos%"=="true" title Performing system refresh... (Saving user description)

if "%sos%"=="true" title Performing system refresh... (Checking hibernation)
if "%hibernated%"=="" set hibernated=false
if "%sos%"=="true" title Performing system refresh... (Saving hibernation)
@echo hibernated=%hibernated%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Checking session)
if "%hibernated%"=="true" goto checkhiberstuff1
:resumerestore1
if "%sos%"=="true" title Performing system refresh... (Saving session)
@echo restore=%restore%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Checking user color)
if "%usercolor%"=="" set usercolor=07
if "%sos%"=="true" title Performing system refresh... (Saving user color)

if "%sos%"=="true" title Performing system refresh... (Checking admin color)
if "%admincol%"=="" set admincol=07
if "%sos%"=="true" title Performing system refresh... (Saving admin color)
@echo admincol=%admincol%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Checking logon color)
if "%logoncolor%"=="" set logoncolor=07
if "%sos%"=="true" title Performing system refresh... (Saving logon color)
@echo logoncolor=%logoncolor%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Checking guest color)
if "%guestcolor%"=="" set guestcolor=07
if "%sos%"=="true" title Performing system refresh... (Saving guest color)
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Checking factory)
if "%factory%"=="" set factory=no
if "%sos%"=="true" title Performing system refresh... (Saving factory)
@echo factory=no,>> config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Checking oldstart)
if "%oldstart%"=="" set oldstart=false
if "%sos%"=="true" title Performing system refresh... (Saving oldstart)
@echo oldstart=%oldstart%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Checking guest)
if "%noguest%"=="" set noguest=false
if "%sos%"=="true" title Performing system refresh... (Saving guest)
@echo noguest=%noguest%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Checking autoreset)
if "%autoreset%"=="" set autoreset=true
if "%sos%"=="true" title Performing system refresh... (Saving autoreset)
@echo autoreset=%autoreset%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Checking administrator)
if "%adno%"=="" set adno=false
if "%sos%"=="true" title Performing system refresh... (Saving administrator)
@echo adno=%adno%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Checking admin's name)
if "%adname%"=="" set adname=Administrator
if "%sos%"=="true" title Performing system refresh... (Saving admin's name)
@echo adname=%adname%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Saving admin's description)
@echo admindescript=%admindescript%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Checking logon screen)
if "%classic%"=="" set classic=false
if "%sos%"=="true" title Performing system refresh... (Saving logon screen)
@echo classic=%classic%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Checking fullscreen)
if "%fullscreen%"=="" set fullscreen=false
if "%sos%"=="true" title Performing system refresh... (Checking autologon)
if "%autologon%"=="" set autologon=false
if "%sos%"=="true" title Performing system refresh... (Saving autologon)
@echo autologon=%autologon%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Saving autologon's name)
@echo loginname=%loginname%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Performing system refresh... (Checking nopass settings)
if "%nopass%"=="" set nopass=no
if "%noupass%"=="" set noupass=false
if "%sos%"=="true" title Performing system refresh... (Saving nopass settings)
@echo nopass=%nopass%,>>config_os\%OSname%.settings
@echo noupass=%noupass%,>>config_os\%OSname%.settings
@echo compatibility=no,>>config_os\%OSname%.settings
title Performing system refresh... (Checking domain)
if "%domain%"=="" set domain=logos_settings
if "%domain%"=="logos_settings" title Performing system refresh... (Saving domain)&@echo domain=logos_settings,>>config_os\%OSname%.settings
title Performing system refresh... (Checking resolution)
if "%resolution%"=="" set resolution=seven
title Performing system refresh... (Saving resolution)
::@echo resolution=%resolution%,>>config_os\%OSname%.settings
title Performing system refresh... (Saving constart)
if "%constart%"=="" set constart=false
if "%skiplogos%"=="true" set constart=true
@echo constart=%constart%,>>config_os\%OSname%.settings
if "%sounded%"=="" set sounded=true
@echo.sounded=%sounded%,>>config_os\%OSname%.settings
title Please wait...
if "%sos%"=="true" title Checking variables
if not "%autologon%"=="" set handleone=succ
set handletwo=%handleone%
if "%sos%"=="true" title Checking logos_settings
if exist config_os\%OSname%.settings set handleone=%handletwo%ess
if "%sos%"=="true" title Checking checking results
if "%handleone%"=="success" del log_os\log.txt&color 0F&set sel=5&goto loopersafe
if "%sos%"=="true" title Checking for other errors...
if "%handleone%"=="ess" goto makec
if "%handleone%"=="" goto wcfix
goto loopersafe

:wcfix
SET userg=
SET n=
SET ip=
SET rndcolor=
SET adminpass=
SET answer5=
SET pw=
SET pp=
SET userdescription=
set hibernated=
set restore=
set usercolor=
set admincol=
set logoncolor=
set guestcolor=
SET factory=
SET noguest=
SET autoreset=
SET adno=
SET an=
SET gn=
SET adname=
SET admindescript=
SET classic=
SET fullscreen=
SET autologon=
SET loginname=
SET nopass=
SET noupass=
SET now=
SET compat=
SET slogo=
SET recoveryaccess=
set compatibility=
SET domain=
del config_os\%OSname%.settings
del boot_os\logos_logo.bat
goto logos


:wcfixr
SET userg=
SET n=
SET ip=
SET rndcolor=
SET adminpass=
SET answer5=
SET pw=
SET pp=
SET userdescription=
set hibernated=
set restore=
set usercolor=
set admincol=
set logoncolor=
set guestcolor=
SET factory=
SET noguest=
SET autoreset=
SET adno=
SET an=
SET gn=
SET adname=
SET admindescript=
SET classic=
SET fullscreen=
SET autologon=
SET loginname=
SET nopass=
SET noupass=
SET now=
SET compat=
SET slogo=
SET recoveryaccess=
set compatibility=
SET domain=
goto :eof
:checkhiberstuff1
goto resumerestore1

:makec
if not exist "%homedrive%\LOGOS" md "%homedrive%\LOGOS"
copy "" %0 "%homedrive%\LOGOS" >nul
copy config_os\%OSname%.settings "%homedrive%\LOGOS" >nul
copy boot_os\logos_logo.bat "%homedrive%\LOGOS" >nul
cd %homedrive%\LOGOS
if exist log_os\lgr del log_os\lgr
call :wcall
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
start /b "" %0
exit

:logostemporary
if exist log_os\log.txt del log_os\log.txt
Echo. Continueing to load Log OS...
color 0F
goto a28


:activatefscreen
if "%sos%"=="true" title Output
Echo.
goto really23

:restorenormalwindowmode
if "%sos%"=="true" title Setting fullscreen as false
set fullscreen=false
if "%sos%"=="true" title Adding registry key
reg add HKCU\Console\ /v Fullscreen /t REG_DWORD /d 0 /f >nul
if "%sos%"=="true" title Saving stuff
@echo recover=true,>>config_os\%OSname%.settings
@echo reason=Your OS doesn't support fullscreen mode,>>config_os\%OSname%.settings
if "%sos%"=="true" title Restarting LogOS
if "%sos%"=="true" title Exit
if exist log_os\lgr del log_os\lgr
call :wcall
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
start /b "" %0
exit

:notchoice
if "%now%"=="true" goto a28
if "%sos%"=="true" title Resuming...
ping localhost -n 1 >nul

:a28
if exist boot_os\bootscreen1.cmd set hoting=true&goto hidescreen2
if exist factorial del factorial
reg add "HKCU\Software\Microsoft\Command Processor" /v DefaultColor /t REG_DWORD /d 7 /f >nul
if "%hoting%"=="true" goto hidescreen2
if "%hibernated%"=="true" goto hidescreen2
if exist hiberstore goto hidescreen2
bin_os\bg.exe locate 0 0
for /l %%a in (1 1 %blank_h%) do (
Echo.%blankspace%               
)
Echo.%blankspace%     ³     
Echo.%minispace% ³     
Echo.%minispace%    ³     ù    
Echo.%minispace%    ³    ùù   
Echo.%minispace%  À Ä  Ä  Ä  Ä  Ä              
Echo.%blankspace%               
Echo.%minispace% Starting LogOS...                                  
if "%constart%"=="true" goto hidescreen2
bg _kbd
set key=%errorlevel%
if "%key%"=="27" set setup=true&goto bootoption
:hidescreen2
if exist hiberstore goto hidescreen3
if "%hibernated%"=="true" set constart=false
if exist log_os\terminate del log_os\terminate
bg _kbd
if "%key%"=="115" set /a expand=3&cls&color 1f&bin_os\bg.exe locate 1 0&echo. Advanced startup menu&set sel=3&goto loopersafe
if "%key%"=="114" set fastload=true&goto sfrec
if "%key%"=="111" set nos=true
if "%key%"=="83" set /a expand=!screen_h!/2+5&goto loopersafe
if "%key%"=="82" set fastload=true&goto sfrec
if "%key%"=="79" set nos=true
if "%constart%"=="true" Echo Saving log...
if "%sos%"=="true" title Saving log
if not "%live%"=="true" @echo. Startup cancelled>>log_os\log.txt
if "%sos%"=="true" title Setting variable
if "%constart%"=="true" Echo Setting title
if exist hiberstore goto hidescreen3
set OSNAME=LogOS
if "%hoting%"=="true" goto hidescreen3
if exist boot_os\bootscreen1 goto hidescreen3
bin_os\bg.exe locate 0 0
for /l %%a in (1 1 %blank_h%) do (
Echo.%blankspace%               
)
Echo.%blankspace%    ³     
Echo.%minispace%   ³    
Echo.%minispace%    ³     ù    
Echo.%minispace%    ³   ùù   
Echo.%minispace%   ÀÄ Ä  Ä Ä Ä              
Echo.%blankspace%               
:hidescreen3
if exist hiberstore goto hidescreen4
if "%adminpass%"=="" goto refresherrors
bg _kbd
set key=%errorlevel%
if "%key%"=="27" set setup=true&goto bootoption
if "%constart%"=="true" Echo Hibernate/factory check
if "%sos%"=="true" title Checking if factory setting is enabled
if "%factory%"=="yes" goto resumereset
if "%sos%"=="true" title Checking for hibernation...
:beginning
if "%constart%"=="true" Echo Beginning to load %OSname% 
if "%now%"=="true" goto donotcall
if exist boot_os\bootscreen1.cmd call boot_os\bootscreen1.cmd&goto hidescreen4
if exist hiberstore goto hidescreen4
if "%hoting%"=="true" goto hidescreen4
:donotcall
if exist boot_os\bootscreen1.cmd goto hidescreen4
bin_os\bg.exe locate 0 0
set /a blank_h=!screen_h!-4
for /l %%a in (1 1 %blank_h%) do (
Echo.%blankspace%               
)
Echo.%blankspace%   ³     
Echo.%minispace%    ³      
Echo.%minispace%    ³    ù    
Echo.%minispace%    ³  ùù    
Echo.%minispace%    ÀÄÄ  ÄÄ Ä              
Echo.%blankspace%               
:hidescreen4
if exist hiberstore goto hidescreen5
if "%guestcolor%"=="" goto refresherrors
if "%factory%"=="" goto refresherrors
bg _kbd
set key=%errorlevel%
if "%key%"=="27" set setup=true&goto bootoption
if "%sos%"=="true" title Checking if this is first run
if exist log_os\log.txt del log_os\log.txt
if not exist "config_os\%OSname%.settings" SET factory=true&del log_os\LogOS_is_running&goto wud3
if "%sos%"=="true" title Deleting log
if "%now%"=="true" goto donotcall2
:donotcall2
if exist boot_os\bootscreen2.cmd call boot_os\bootscreen2.cmd&goto hidescreen5
if exist Starting_up del Starting_up
if "%sos%"=="true" title Setting color to 0F
if "%now%"=="true" goto donotcall1
if "%hoting%"=="true" goto hidescreen5
if exist hiberstore goto hidescreen5
bin_os\bg.exe locate 0 0
for /l %%a in (1 1 %blank_h%) do (
Echo.%blankspace%               
)
Echo.%blankspace%  ³     
Echo.%minispace%    ³      
Echo.%minispace%    ³   ù    
Echo.%minispace%    ³ ù ù    
Echo.%minispace%    ÀÄÄ ÄÄÄ              
Echo.%blankspace%               
:hidescreen5
if "%hibernated%"=="" goto refresherrors
if exist hiberstore goto hidescreen6
bg _kbd
set key=%errorlevel%
if "%key%"=="27" set setup=true&goto bootoption
if exist boot_os\bootscreen3.cmd call boot_os\bootscreen3.cmd&goto donotcall1
bin_os\bg.exe locate 0 0
:donotcall1
if "%now%"=="true" goto donotcall3
:donotcall3
if "%constart%"=="true" Echo Set empty variable
if "%sos%"=="true" title Setting attempt for TIME
if "%hoting%"=="true" goto hidescreen6
if "%hibernated%"=="true" goto hidescreen6
if exist hiberstore goto hidescreen6
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if exist boot_os\bootscreen4.cmd call boot_os\bootscreen4.cmd&goto hidescreen6
bin_os\bg.exe locate 0 0
for /l %%a in (1 1 %blank_h%) do (
Echo.%blankspace%               
)
Echo.%blankspace% ³     
Echo.%minispace%    ³      
Echo.%minispace%    ³  ù    
Echo.%minispace%    ³ ù ù    
Echo.%minispace%    ÀÄÄÄÄÄ              
Echo.%blankspace%               
:hidescreen6
if exist hiberstore goto hidescreen7
if "%usercolor%"=="" goto refresherrors
if "%admincol%"=="" goto refresherrors
if "%logoncolor%"=="" goto refresherrors
bg _kbd
set key=%errorlevel%
if "%key%"=="27" set setup=true&goto bootoption
if "%hibernated%"=="true" set constart=false
set t=0
if "%now%"=="true" goto donotcall0
if exist boot_os\bootscreen5.cmd call boot_os\bootscreen5.cmd&goto donotcall0
:donotcall0
if "%sos%"=="true" title Saving pointless log
if "%constart%"=="true" Echo Load admin
Echo Loadingadministratorthings >> Loading_administrator_things
if "%now%"=="true" goto donotcall6
:donotcall6
if "%constart%"=="true" Echo Set password if neccessary
if "%sos%"=="true" title Setting administrator password
if exist hiberstore goto hidescreen7
if "%hoting%"=="true" goto hidescreen7
if exist boot_os\bootscreen6.cmd call boot_os\bootscreen6.cmd&goto hidescreen7
bin_os\bg.exe locate 0 0
for /l %%a in (1 1 %blank_h%) do (
Echo.%blankspace%               
)
Echo.%blankspace%³     
Echo.%minispace%    ³      
Echo.%minispace%    ³ ù    
Echo.%minispace%    ³ ù ù    
Echo.%minispace%    ÀÄÄÄÄÄ              
:hidescreen7
if exist hiberstore goto hidescreen8
if "%noguest%"=="" goto refresherrors
if "%autoreset%"=="" goto refresherrors
Echo.%blankspace%               
bg _kbd
set key=%errorlevel%
if "%key%"=="27" set setup=true&goto bootoption
if not exist config_os\%OSname%.settings set adminpass=administratorhasmanyrights
if "%now%"=="true" goto donotcall5
if exist boot_os\bootscreen7.cmd call boot_os\bootscreen7.cmd&goto donotcall5
:donotcall5
if "%constart%"=="true" Echo Finished admin
if "%sos%"=="true" title Deleting pointless log
if exist Loading_administrator_things del Loading_administrator_things
if "%now%"=="true" goto donotcall4
if exist boot_os\bootscreen8.cmd call boot_os\bootscreen8.cmd&goto donotcall4
:donotcall4
if "%sos%"=="true" title Checking for DISKINFO.COM
if "%constart%"=="true" Echo Check for compat
if "%compat%"=="yes" goto loadingagain
:skipboot0
if "%sos%"=="true" title Resizing Window
if "%sos%"=="true" title Saving log
if not "%live%"=="true" echo  not found>>log_os\log.txt
if exist boot_os\bootscreen10.cmd goto loadingagain
if exist hiberstore goto hidescreen8
if "%hoting%"=="true" goto hidescreen8
if exist boot_os\bootscreen9.cmd call boot_os\bootscreen9.cmd&goto hidescreen8
bin_os\bg.exe locate 0 0
for /l %%a in (1 1 %blank_h%) do (
Echo.%blankspace%               
)
Echo.%minispace%     ³     
Echo.%minispace%    ³      
Echo.%minispace%    ³ ù    
Echo.%minispace%    ³ ùù    
Echo.%minispace%    ÀÄÄÄÄÄ              
Echo.%blankspace%               
:hidescreen8
if exist hiberstore goto hidescreen9
if "%adno%"=="" goto refresherrors
if "%adname%"=="" goto refresherrors
if "%classic%"=="" goto refresherrors
bg _kbd
set key=%errorlevel%
if "%key%"=="27" set setup=true&goto bootoption
:loadingagain
if "%now%"=="true" goto donotcall55
if exist boot_os\bootscreen10.cmd call boot_os\bootscreen10.cmd&goto donotcall55
:donotcall55
if "%now%"=="true" goto donotcall66
if exist hiberstore goto hidescreen9
if "%hoting%"=="true" goto hidescreen9
:donotcall66
if exist boot_os\bootscreen11.cmd call boot_os\bootscreen11.cmd&goto hidescreen9
bin_os\bg.exe locate 0 0
for /l %%a in (1 1 %blank_h%) do (
Echo.%blankspace%               
)
Echo.%minispace%     ³     
Echo.%minispace%     ³      
Echo.%minispace%     ³ù    
Echo.%minispace%    ³ùù    
Echo.%minispace%    ÀÄÄÄÄÄ              
Echo.%blankspace%               
:hidescreen9
if "%finishflash%"=="true" del log_os\Shutdown
if exist hiberstore goto hidescreen10
if "%fullscreen%"=="" set fullscreen=true
if "%autologon%"=="" goto refresherrors&bg _kbd
set key=%errorlevel%
if "%key%"=="27" set setup=true&goto bootoption
if "%sos%"=="true" title Setting color to 0F
if exist hiberstore goto hidescreen10
if "%hoting%"=="true" goto hidescreen10
if exist boot_os\bootscreen11 goto hidescreen10
bin_os\bg.exe locate 0 0
for /l %%a in (1 1 %blank_h%) do (
Echo.%blankspace%               
)
Echo.%blankspace%³     
Echo.%blankspace%³      
Echo.%blankspace%³ù    
Echo.%minispace%     ³ùù    
Echo.%minispace%    ÀÄÄÄÄÄ              
Echo.%blankspace%               
:hidescreen10
if exist succeed_key echo Press DEL key now...
if exist succeed_key ping localhost -n 2 >nul
bg _kbd
if "%key%"=="338" title Please wait...&goto setupboot
:delkey
if exist succeed_key color CF&ping localhost -n 5 >nul&del succeed_key&goto EFI
if exist hiberstore goto hidescreen11
bg _kbd
if "%nopass%"=="" goto refresherrors
if "%noupass%"=="" goto refresherrors
set key=%errorlevel%
if "%key%"=="27" set setup=true&goto bootoption
if "%sos%"=="true" title Showing %OSname% logo
if "%now%"=="true" goto donotcall11
if exist boot_os\bootscreen12.cmd call boot_os\bootscreen12.cmd&goto donotcall11
:donotcall11
if "%constart%"=="true" Echo Add registry key if it is log_os\firstuse
if exist log_os\firstuse reg add HKCU\Console\ /v Fullscreen /t REG_DWORD /d 0 /f >nul
if "%now%"=="true" goto donotcall00
if exist boot_os\bootscreen13.cmd call boot_os\bootscreen13.cmd
if exist boot_os\bootscreen14.cmd call boot_os\bootscreen14.cmd&goto donotcall00
:donotcall00
if "%constart%"=="true" Echo Change title
if "%sos%"=="true" title Setting color variable

if "%now%"=="true" goto donotcall100
if exist boot_os\bootscreen15.cmd call boot_os\bootscreen15.cmd&goto donotcall100
:donotcall100
set color=07
if "%sos%"=="true" title Connecting to domain
if exist %domain% goto domaincall
if "%sos%"=="true" title Setting user as no one
if "%now%"=="true" goto donotcall500
:callit500
if exist boot_os\bootscreen16.cmd call boot_os\bootscreen16.cmd&goto domaincall500
goto donotcall500
:domaincall
color 8F
@echo. Domain call exception: %domain% not a callable file>>log_os\log.txt
call %domain%
goto callit500

:freshmessage
cls
Echo.
Echo Thank you for installing Log OS %version%
Echo.
Echo Please make sure that you have read the readme
Echo documentation before using the OS. Go to about
Echo to see new features.
Echo.
Echo Press any key to continue loading Log OS...
Pause >nul
set "log_os\freshboot="
goto hidescreen12

:finis
if exist bin_os\bg.exe bg cursor 0
if "%constart%"=="false" cls
Echo You have just upgraded from version %preversion%
Echo to %version%
Echo.
Echo Please go to about to see new features.
Echo.
Echo Press any key to continue loading Log OS...
Pause >nul
if exist bin_os\bg.exe bg cursor 1
set finishflash=
goto hidescreen12
:donotcall500
:domaincall500
if "%sos%"=="true" title Checking if %OSname% settings don't exist
if not exist config_os\%OSname%.settings goto beginning
if "%now%"=="true" goto donotcall9
if exist boot_os\bootscreen17.cmd call boot_os\bootscreen17.cmd&goto donotcall9
:donotcall9
if "%sos%"=="true" title Checking if pointless file exists
if exist logossettings.cmd del logossettings.cmd
if "%now%"=="true" goto donotcall99
if exist boot_os\bootscreen18.cmd call boot_os\bootscreen18.cmd&goto donotcall99
:donotcall99
if exist logos del logos
if "%sos%"=="true" title Deleting log
if "%now%"=="true" goto donotcall999000
if exist boot_os\bootscreen19.cmd call boot_os\bootscreen19.cmd&donotcall999000
:donotcall999000
if exist log_os\log.txt del log_os\log.txt
if "%sos%"=="true" title Clearing screen
if "%sos%"=="true" title Setting color to 0F
if "%now%"=="true" goto donotcall9090909090
if exist hiberstore goto hidescreen11
if "%hoting%"=="true" goto hidescreen11
:donotcall9090909090
if exist boot_os\bootscreen20.cmd call boot_os\bootscreen20.cmd&goto hidescreen11
bin_os\bg.exe locate 0 0
for /l %%a in (1 1 %blank_h%) do (
Echo.%blankspace%               
)
Echo.%blankspace%³     
Echo.%blankspace%³      
Echo.%blankspace%³ù    
Echo.%blankspace%³ùù    
Echo.%minispace%     ÀÄÄÄÄÄ              
Echo.%blankspace%               
:hidescreen11
if "%constart%"=="" goto refresherrors
if "%skiplogos%"=="true" set constart=true
if "%sounded%"=="" set sounded=false
bg _kbd
set key=%errorlevel%
if "%key%"=="27" set setup=true&goto bootoption
if "%now%"=="true" goto donotwait
:donotwait
if "%hoting%"=="true" goto hidescreen12
if "%hibernated%"=="true" goto hidescreen12
if exist hiberstore goto hidescreen12
set "hoting="
if "%hibernated%"=="true" set constart=false
if "%sos%"=="true" title Checking for autologon...
if "%constart%"=="true" Echo Check for autologon users
if exist boot_os\bootscreen20 goto hidescreen12
bin_os\bg.exe locate 0 0
for /l %%a in (1 1 %blank_h%) do (
Echo.%blankspace%               
)
Echo.%blankspace%³     
Echo.%blankspace%³      
Echo.%blankspace%³ù    
Echo.%blankspace%³ùù    
Echo.%blankspace%ÀÄÄÄÄÄ              
Echo.%blankspace%               
if "%finishflash%"=="true" goto finis
:hidescreen12
if exist hiberstore del hiberstore
if "%log_os\freshboot%"=="yes" goto freshmessage
bg _kbd
set key=%errorlevel%
if "%key%"=="27" set setup=true&goto bootoption
if "%hibernated%"=="true" call :lastsession&goto lastfade
if "%autologon%"=="enabled" goto autologonnow
if exist white del white
if "%constart%"=="true" Echo Setting resolution
if exist bin_os\bg.exe bg font %res%
if exist crash del crash&goto aprilfools
goto logon

:seriouserror
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Perform system refresh (2 times if neccessary)
Echo. - Perform factory reset
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback.html
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E266 - Console initialization error
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E266 - Console initialization error>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
:look
if "%countdown%"=="true" goto restarter
goto look

:illegalaction
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Perform system refresh (2 times if neccessary)
Echo. - Perform factory reset
echo. - Upgrade the version if possible
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback.html
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E420 - Illegal action
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E420 - Illegal action>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
:looky
if "%countdown%"=="true" goto restarter
goto looky

:restarter
Echo Log OS will automatically restart in 8 seconds
ping localhost -n 3 >nul
ping localhost -n 3 >nul
ping localhost -n 3 >nul
ping localhost -n 3 >nul
start /b "" %0
exit

:logon
set /a maindot=0
set "tempfs="
if "%adminpass%"=="" set hoting=true&goto a28
if not "%hibernated%"=="true" color 07
if not "%hibernated%"=="true" ping localhost -n 1 >nul
if not "%hibernated%"=="true" color 08
if not "%hibernated%"=="true" ping localhost -n 1 >nul
if not "%hibernated%"=="true" cls
if not "%hibernated%"=="true" ping localhost -n 1 >nul
bg font 6
mode %screen_w%,%screen_h%
if not "%autorun%"=="" goto %autorun%
set logonsel=1
if "%constart%"=="" goto seriouserror
if "%constart%"=="true" goto classiclogon
if not exist specific_os\root\audio\Startup.wav set sounded=false
if "%pp%"=="" set noupass=true
if not "%fullscreen%"=="true" mode %screen_w%,%screen_h%
bin_os\bg.exe locate 0 0
set now=
set restore=
set hibernated=false
if exist bin_os\bg.exe bg cursor 1
set errorcheck=0
if "%autologon%"=="" goto setup1
if "%sos%"=="true" title Applying logon color
if "%logoncolor%"=="" goto recoveryerror
if "%n%"=="" set logonisen=true&goto fixnumber
if "%an%"=="" set logonisen=true&goto fixadnumber
if "%gn%"=="" set logonisen=true&goto fixgnumber
color %logoncolor%
if "%sos%"=="true" title Deleting desktop log (if exists)
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if "%sos%"=="true" title Saving logon log
Echo log_os\Logonscreen >> log_os\Logonscreen
if "%sos%"=="true" title Setting color to 0F
if not "%hibernated%"=="true" color 0F
:loly
if not "%hibernated%"=="true" color %logoncolor%
if "%sos%"=="true" title Checking if fullscreen if enabled
if "%sos%"=="true" title Checking for classic logon
if "%classic%"=="true" goto classiclogon
if "%sos%"=="true" title Checking for guest setting
if "%adno%"=="true" set "an="
if "%userg%"=="" set "n="
set /a maxint=1
for /f %%a in ('dir /b config_user') do (
	set "temp=%%a"
	if not "!temp!"=="!temp:.settings=!" (
		set "uu!maxint!=!temp:.settings=!"
		set /a maxint+=1
	)
)
if "%noguest%"=="false" set /a gn=!maxint!
if "%noguest%"=="" set noguest=false
if "%noguest%"=="false" set /a maxint+=1
if "%noguest%"=="true" set "gn="
if "%livelocal%"=="true" goto skchejk
if "%domain%"=="" goto skchejk
if "%domain%" NEQ "logos_settings" goto domainlogon
:skchejk
if "%sos%"=="true" title Applying logon color
color %logoncolor%
if "%sos%"=="true" title Saving log
if "%sos%"=="true" title Clearing screen
if not "%autologon%"=="enabled" cls
if "%sos%"=="true" title Output
if "%adno%"=="true" set an=
set errorcheck=1
:restorelogon
cls
color %logoncolor%
:logonsabal
bg cursor 0
set /a plogonsel=!logonsel!-1
set /a nlogonsel=!logonsel!+1
title Login screen
bin_os\bg.exe locate 0 0
set hour=%time:~0,2%
if "%hour:~0,1%" == " " set hour=0%hour:~1,1%
set min=%time:~3,2%
if "%min:~0,1%" == " " set min=0%min:~1,1%
if "%maindot%"=="0" (
	if "%colon%"==":" (
		set "colon= "
	) else (
		set "colon=:"
	)
)
if "%colon%"=="" set "colon=:"
Echo.
Echo.%minispace%     %hour%%colon%%min%
Echo.
Echo.%blankspace%                                                
Echo.%blankspace%                                                
Echo.%blankspace%     
if %plogonsel% GTR 0 (
	bin_os\chgcolor %logoncolor:~0,1%8
	if "%plogonsel%"=="%gn%" Echo.%minispace% %gn%.Guest                         
	if not "%plogonsel%"=="%gn%" (
		echo.%minispace% %plogonsel%.!uu%plogonsel%!                       
	)
) else (
echo.%minispace%                   
)
if not "%logoncolor:~0,1%"=="f" (
	if not "%logoncolor:~0,1%"=="F" (
		bin_os\chgcolor %logoncolor:~0,1%f
	) else (
		bin_os\chgcolor %logoncolor:~0,1%0
	)
) else (
	bin_os\chgcolor %logoncolor:~0,1%0
)
if "%logonsel%"=="%gn%" Echo.%minispace% %gn%.Guest                         
if not "%logonsel%"=="%gn%" (
	echo.%minispace% %logonsel%.!uu%logonsel%!                       
)
if %nlogonsel% GTR 0 (
	bin_os\chgcolor %logoncolor:~0,1%8
	if "%nlogonsel%"=="%gn%" Echo.%minispace% %gn%.Guest                         
	if not "%nlogonsel%"=="%gn%" (
		if not "!uu%nlogonsel%!"=="" (
			echo.%minispace% %nlogonsel%.!uu%nlogonsel%!                       
		) else (
			echo.%minispace%                   
		)
	)
) else (
echo.%minispace%                   
)
bin_os\chgcolor %logoncolor%
Echo.%blankspace%      
if "%sos%"=="true" title Checking if user is available
if "%sos%"=="true" title Output
Echo.%blankspace%                   
:sifu
Echo.%blankspace%                   
Echo.%tinyspace%Up/Down arrow keys - Select user account                      
Echo.%tinyspace%Enter - Enter user account
Echo.%tinyspace%S - Shutdown
Echo.%tinyspace%R - Restart
Echo.
set /a vnum=%vnum%+1
if "%vnum%"=="300" call :screensave
if "%sos%"=="true" title Output
if "%sos%"=="true" title Waiting for user input
bin_os\bg.exe locate 0 0
if "%sos%"=="true" title Searching for %answer%
set livelocal=false
bg _kbd
set key=%errorlevel%
set lastsel=%logonsel%
if "%key%"=="389" set "vnum="&goto troubleshooter
if "%key%"=="388" set "vnum="&cls&bg cursor 1&call :delbs
if "%key%"=="338" set "vnum="&goto logonsetup
if "%key%"=="362" set "vnum="&goto shutdown
if "%key%"=="348" set "vnum="&goto cmderror
if "%key%"=="335" set "vnum="&goto ds
if "%key%"=="332" set "vnum="&goto ds
if "%key%"=="330" set "vnum="&goto us
if "%key%"=="327" set "vnum="&goto us
if "%key%"=="318" set "vnum="&goto logon
if "%key%"=="115" set "vnum="&goto shutdown
if "%key%"=="114" set "vnum="&goto restart
if "%key%"=="104" set restore=loly&goto hiber
if "%key%"=="99" set "vnum="&set classic=true&goto classiclogon
if "%key%"=="83" set "vnum="&goto shutdown
if "%key%"=="82" set "vnum="&goto restart
if "%key%"=="72" set "vnum="&set restore=loly&goto hiber
if "%key%"=="57" set "vnum="&set logonsel=9&goto kamncheck
if "%key%"=="56" set "vnum="&set logonsel=8&goto kamncheck
if "%key%"=="55" set "vnum="&set logonsel=7&goto kamncheck
if "%key%"=="54" set "vnum="&set logonsel=6&goto kamncheck
if "%key%"=="53" set "vnum="&set logonsel=5&goto kamncheck
if "%key%"=="52" set "vnum="&set logonsel=4&goto kamncheck
if "%key%"=="51" set "vnum="&set logonsel=3&goto kamncheck
if "%key%"=="50" set "vnum="&set logonsel=2&goto kamncheck
if "%key%"=="49" set "vnum="&set logonsel=1&goto kamncheck
if "%key%"=="42" set "vnum="&goto discologin
if "%key%"=="32" set "vnum="&goto freetext
if "%key%"=="27" set "vnum="&goto powermenu
if "%key%"=="19" set "vnum="&goto logonsetup
if "%key%"=="13" set "vnum="&bg cursor 1&goto checklogonsel
if "%sos%"=="true" title Returning to logon screen
set /a maindot+=1
if "%maindot%"=="10" set /a maindot=0
goto logonsabal

:screensave
set "vnum="
SET /A saver=%RANDOM% * 2 / 32768 + 1
color %logoncolor%
if "%saver%"=="2" goto logosaver
if "%saver%"=="3" goto fadesaver
cls
set message=Log OS technologies
set /a messagelen=19
:slp
bin_os\bg.exe locate 0 0
set /a y=5
set /a x=5
set /a xmax=!screen_w!-!messagelen!
set /a ymax=!screen_h!-2
set /a directx=1
set /a directy=1
:nslp
cls
for /l %%a in (1 1 !y!) do echo.
set "pspc="
for /l %%a in (1 1 !x!) do set "pspc=!pspc! "
echo.!pspc!!message!
set /a x+=!directx!
set /a y+=!directy!
if !x! GTR !xmax! set /a directx=-1&set /a x-=1
if !y! GTR !ymax! set /a directy=-1&set /a y-=2
if !x! LSS 0 set /a directx=1&set /a x+=1
if !y! LSS 0 set /a directy=1&set /a y+=2
title Press any key to continue...
bg _kbd
if not "%errorlevel%"=="0" (
if "%user%"=="" goto restorelogon
if not "%user%"=="" goto start
)
goto nslp

:logosaver
color 08
:lslp
bin_os\bg.exe locate 0 0
set /a xmax=!screen_w!-7
set /a ymax=!screen_h!-7
set /a y=%RANDOM% * !ymax! / 32768 + 1
set /a x=%RANDOM% * !xmax! / 32768 + 1
:lnslp
cls
for /l %%a in (1 1 !y!) do echo.
set "pspc="
for /l %%a in (1 1 !x!) do set "pspc=!pspc! "
Echo.!pspc!³    
Echo.!pspc!³    
Echo.!pspc!³ù    
Echo.!pspc!³ùù   
Echo.!pspc!ÀÄÄÄÄÄ
set /a x+=!directx!
set /a y+=!directy!

title Press any key to continue...
set /a y=%RANDOM% * !ymax! / 32768 + 1 2>nul
set /a x=%RANDOM% * !xmax! / 32768 + 1 2>nul
bg sleep 42
color 07
bg sleep 42
color 0f
for /l %%a in (1 1 10) do (
bg sleep 100
bg _kbd
if not "!errorlevel!"=="0" goto resumesaver
)
color 07
bg sleep 42
color 08
bg sleep 42
cls
bg sleep 42
goto lnslp

:resumesaver
if "%user%"=="" goto restorelogon
if not "%user%"=="" goto start
goto logos

:fadesaver
color 08
bg sleep 42
for /l %%a in (1 1 10) do (
bg sleep 100
bg _kbd
if not "!errorlevel!"=="0" goto resumesaver
)
color 87
bg sleep 42
color 78
bg sleep 42
color f0
bg sleep 42
for /l %%a in (1 1 10) do (
bg sleep 100
bg _kbd
if not "!errorlevel!"=="0" goto resumesaver
)
color 78
bg sleep 42
color 87
bg sleep 42
goto fadesaver

:discologin
bg cursor 1
color 0F
cls
:dlog
set "line="
call :createdisco
echo !line!
bg _kbd
set key=%errorlevel%
if not "%key%"=="0" goto loly
goto dlog

:createdisco
set "line=%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%%random:~0,1%"
if "!cnt!"=="!maxcnt!" goto :eof
goto discoloop

:delbs
bg cursor 1
cls
bin_os\bg.exe locate 0 0
color 0F
call :writebsdeleter
echo eCMD version 1.2
set /a skip=0
set cfile=specific_os\root\document\delete_bootscreen.cs
set endscript=true
call :knowncfile
bg cursor 0
goto logon

:troubleshooter
bg cursor 1
color 0F
call :writeloginfixer
cls
echo eCMD version 1.2
set /a skip=0
set cfile=specific_os\root\document\login_fixer.cs
set endscript=true
call :knowncfile
bg cursor 0
goto logon

:cmderror
bg cursor 1
color 0F
cls
echo eCMD version 1.2
echo.
echo To enter command prompt, please log in
echo.
Pause
goto loly

:powermenu
cls
Echo.
Echo What would you like to do?
Echo.
Echo S Shut down
Echo R Restart
Echo H Hibernate
Echo B Hotboot
Echo D Recovery
Echo.
Echo ESC Go back
:buttonmenu
bg kbd
set key=%errorlevel%
if "%key%"=="115" goto shutdown
if "%key%"=="114" goto restart
if "%key%"=="104" set restore=logon&goto hiber
if "%key%"=="100" goto recoverboot
if "%key%"=="98" goto hoting
if "%key%"=="68" goto recoverboot
if "%key%"=="66" goto hoting
if "%key%"=="27" goto loly
goto buttonmenu

:freetext
set /p text=
if "%text%"=="exit" goto logon
if "%text%"=="quit" goto logon
if "%text%"==" " goto logon
goto freetext

:ds
set /a logonsel=%logonsel%+1
if %logonsel% GEQ %maxint% set logonsel=%lastsel%
:kamncheck
if %logonsel% GEQ %maxint% set logonsel=%lastsel%
if "%adno%"=="true" call :checkadminvisibly
if "%noguest%"=="true" call :checkguestvisibly
if "%userg%"=="" call :checkuservisibly
if "%logonsel%"=="0" set /a logonsel=1
goto logonsabal

:checkadminvisibly
if "%logonsel%"=="%an%" set /a logonsel=%gn%
goto :eof

:checkadminvisiblyup
if "%logonsel%"=="%an%" set /a logonsel=%n%
goto :eof

:checkguestvisibly
if "%logonsel%"=="%gn%" set /a logonsel=%n%
goto :eof

:checkguestvisiblyup
if "%logonsel%"=="%gn%" set /a logonsel=%an%
goto :eof

:checkuservisibly
if "%logonsel%"=="%n%" set /a logonsel=%an%
goto :eof

:checkuservisiblyup
if "%logonsel%"=="%n%" set /a logonsel=%gn%
goto :eof

:us
set lastsel=%logonsel%
set /a logonsel=%logonsel%-1
if "%logonsel%"=="0" set /a logonsel=1
if "%adno%"=="true" call :checkadminvisiblyup
if "%noguest%"=="true" call :checkguestvisiblyup
if "%userg%"=="" call :checkuservisiblyup
goto logonsabal

:checklogonsel
if "%logonsel%"=="%gn%" goto lg
if exist "config_user\!uu%logonsel%!.settings" (
	for /f %%a in ('dir /b config_user') do (
		if "%%a"=="!uu%logonsel%!.settings" (
			for /f "eol=: delims=," %%a in (config_user\!uu%logonsel%!.settings) do set %%a
			if "!type!"=="Administrator" goto adminstart
			if "!type!"=="User" goto logonasnew
		)
	)
)
set logonsel=1
goto logon

:domainlogon
if "%domainlast%"=="" set so=1&set th=2
if "%domainlast%" NEQ "" set fu=1&set so=2&set th=3
cls
color %logoncolor%
Echo.
Echo.
Echo.
if not "%domainlast%"=="" Echo.                              %fu%.%domainlast%
if "%domainlast%"=="" Echo.
Echo.                              %so%.Other user
Echo.                              %th%.Logon locally
Echo.
Echo.
Echo.   S=Shutdown R=Restart
set/panswer=^>                         Your selection:
cls
cls
cls
if "%answer%"=="%fu%" goto dn
if "%answer%"=="%so%" goto otheruser
if "%answer%"=="%th%" set livelocal=true&goto logon
if "%answer%"=="s" goto shutdown
if "%answer%"=="S" goto shutdown
if "%answer%"=="R" goto restart
if "%answer%"=="r" goto restart
goto logon

:otheruser
cls
color %logoncolor%
Echo.
Echo.
Echo.
Echo.                              Other user
Echo.                               Enter username and password
Echo.
Echo.                              2. Go back
Echo.
Echo.   S=Shutdown R=Restart
set/panswer=Enter username:
set name=%answer%
goto checkdomainuser

:lockscreen
set slmk=lockscreen
if "%hibernated%"=="true" set hibernated=false
if "%user%"=="%adname%" goto checkadminpass
if "%user%"=="%userg%" goto checkusergpass
if "%user%"=="Guest" goto welcome
:lockscreenpass
color %logoncolor%
cls
Echo.
Echo %user%'s account is currently locked
Echo.
if not "%description%"=="" Echo. %description%
if "%description%"=="" Echo Lucky number: %randomm%  Directory: %ld%
if not "%description%"=="" Echo Lucky number: %randomm%   Directory: %ld%
if "%description%"=="" Echo.
Echo Date: %date%  Last logon time: %logontime%
Echo.
Echo. S=Shutdown R=Restart
Echo.
if exist bin_os\bg.exe bg cursor 1
set /p answer=^>          Enter password:
if exist bin_os\bg.exe bg cursor 0
if "%answer%"=="S" goto shutdown
if "%answer%"=="s" goto shutdown
if "%answer%"=="R" goto restart
if "%answer%"=="r" goto restart
if "%user%"=="%adname%" goto checkadmin
if "%user%"=="%userg%" goto checkuser
goto welcome

:checkadmin
if "%nopass%"=="yes" goto welcome
if "%answer%"=="%adminpass%" goto welcome
goto lockscreen

:checkuser
if "%noupass%"=="true" goto welcome
if "%answer%"=="%pp%" goto welcome
goto lockscreen

:checkadminpass
if "%nopass%"=="yes" goto welcome
if "%pp%"=="" goto welcome
goto lockscreenpass

:checkusergpass
if "%noupass%"=="true" goto welcome
if "%pp%"=="" goto welcome
goto lockscreenpass

:logdinglogon
set "tempfs="
set "user="
if "%constart%"=="true" goto classiclogon
if "%live%"=="true" goto logonoff
ping localhost -n 1 >nul
color 07
ping localhost -n 1 >nul
color 08
ping localhost -n 1 >nul
cls
:logonoff
set fastload=
mode %screen_w%,%screen_h%
goto logon


:typetext
if not "%fullscreen%"=="true" mode %screen_w%,%screen_h%
if "%sos%"=="true" title Clearing screen
cls
if "%sos%"=="true" title Output
Echo.
if "%sos%"=="true" title Waiting for user input
set directory=%cd%
if "%sos%"=="true" title Clearing screen 3 times
cls
cls
cls
if "%sos%"=="true" title Checking if directory exists
if not exist %directory% md %directory%
if "%sos%"=="true" title Showing directory
echo.
dir *.txt /a-d
if "%sos%"=="true" title Output
Echo.
if "%sos%"=="true" title Waiting for user input
if exist bin_os\bg.exe bg cursor 1
set /p text=Enter text file to open in "%directory%" :
if exist bin_os\bg.exe bg cursor 0
:typenow
if "%sos%"=="true" title Typing text
if exist "%directory%\%text%.txt" set text=%text%.txt
type "%directory%\%text%"
if "%sos%"=="true" title Waiting for user input...
Pause>nul
if "%sos%"=="true" title Returning to start
if "%retofile%"=="true" goto fe
goto start

:autologonnow
color 07
ping localhost -n 1 >nul
color 08
ping localhost -n 1 >nul
cls
ping localhost -n 1 >nul
bg font 6
mode %screen_w%,%screen_h%
if not exist specific_os\root\audio\Startup.wav set sounded=false
if not "%autorun%"=="" goto %autorun%
if "%constart%"=="" goto seriouserror
if exist white del white
if "%constart%"=="true" Echo Setting login variable
set alogon=setupnow
if "%sos%"=="true" title Checking users for autologon
if "%constart%"=="true" Echo Logging in as %loginname%
if "%loginname%"=="Guest" goto lg
if "%loginname%"=="%adname%" goto aap
if "%loginname%"=="%userg%" goto sn
if "%constart%"=="true" Echo Something went wrong
mode %screen_w%,%screen_h%
:clienterror
echo.%tab%%bck% 2>nul&set /p=<nul
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Perform system refresh (2 times if neccessary)
Echo. - Perform factory reset
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback.html
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E163 - Autologon client encountered an unexcepted error
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E163 - Autologon client encountered an unexcepted error>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look


:lg
if "%constart%"=="true" Echo Setting variables
if "%noguest%"=="true" goto logon
if "%sos%"=="true" title Setting some variables for guest
set randomm=%random%
set logontime=%time%
if "%sos%"=="true" title Clearing screen
if not "%alogon%"=="setupnow" cls
if "%sos%"=="true" title Setting color as guest color
set rndcolor=%guestcolor%
if "%sos%"=="true" title Deleting logon log
if exist log_os\Logonscreen del log_os\Logonscreen
if "%sos%"=="true" title Setting username as Guest
set user=Guest
if "%sos%"=="true" title Setting no password variable
set pass=You don't have password
if "%sos%"=="true" title Setting guest description
set guestdescript=%f1%
set description=%guestdescript%
if "%sos%"=="true" title Showing welcome message
goto welcome

:shutdown
if "%sounded%"=="true" taskkill /F /IM bg.exe >nul&start /B bg play specific_os\root\audio\Startup.wav&bg sleep 100
ping localhost -n 1 >nul
color 08
ping localhost -n 1 >nul
cls
ping localhost -n 1 >nul
color 08
set /a blank_h=%screen_h%/2-5
for /l %%a in (1 1 %blank_h%) do (
Echo.%blankspace%               
)
Echo.%blankspace%³    
Echo.%blankspace%³    
Echo.%blankspace%³ù    
Echo.%blankspace%³ùù   
Echo.%blankspace%ÀÄÄÄÄÄ
Echo.
Echo.%minispace%  Shutting down..
ping localhost -n 1 >nul
if exist bin_os\bg.exe bg.exe cursor 0
if "%sos%"=="true" title Setting color to 07
color 07
ping localhost -n 1 >nul
color 0F
ping localhost -n 1 >nul
if "%sounded%"=="true" ping localhost -n 3 >nul
if "%sos%"=="true" title Deleting logon log
if exist log_os\Logonscreen del log_os\Logonscreen
if "%sos%"=="true" title Deleting desktop log
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if "%sos%"=="true" title Deleting %OSname% log
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if "%sos%"=="true" title Deleting log
if exist log_os\log.txt del log_os\log.txt
if "%sos%"=="true" title Deleting save
if exist save del save
if "%sos%"=="true" title Clearing screen
if "%sos%"=="true" title Saving log
Echo. Error during shutdown >> log_os\log.txt
if "%live%"=="true" goto sureshutdown
if "%sos%"=="true" title Deleting %OSname% settings
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
if "%sos%"=="true" title Saving date
call :savesetup
:sureshutdown
if "%sos%"=="true" title Saving successfull shutdown log
@echo.>>log_os\Shutdown
ping localhost -n 1 >nul
if "%sos%"=="true" title Deleting log_os\log.txt
if exist log_os\log.txt del log_os\log.txt
if "%sos%"=="true" title Deleting temp.txt
if exist temp.txt del temp.txt
if "%sos%"=="true" title Clearing screen
set attempt=1
call :wcall
@echo.::Ends sound driver>>log_os\terminate
taskkill /F /IM bg.exe >nul 2>nul
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
color 07
ping localhost -n 1 >nul
color 08
ping localhost -n 1 >nul
cls
ping localhost -n 1 >nul
:bnos
if "%nos%"=="true" goto bnos
reg add HKCU\Console\ /v Fullscreen /t REG_DWORD /d 0 /f >nul
if exist log_os\lgr del log_os\lgr
exit

:hoting
bg cursor 0
title Restarting (hotboot enabled)
if not "%live%"=="true" @echo Hotboot error>>log_os\log.txt
if exist log_os\Logonscreen del log_os\Logonscreen
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\log.txt del log_os\log.txt
:surehotboot
if "%live%"=="true" goto suredude
call :savesetup
@echo hoting=true,>>config_os\%OSname%.settings
@echo Shutdown was successfull>>log_os\Shutdown
:suredude
if not "%now%"=="sklm" ping localhost -n 1 >nul
if exist log_os\log.txt del log_os\log.txt
if exist temp.txt del temp.txt
cls
@echo.::Ends sound driver>>log_os\terminate
taskkill /F /IM bg.exe >nul 2>nul
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
goto choice1

:adminstart
color %logoncolor%
cls
title Login screen
Echo.
Echo.%minispace%     %hour%:%min%
Echo.
Echo.%blankspace%                                                
Echo.%blankspace%                                                
Echo.%blankspace%     
if %plogonsel% GTR 0 (
	bin_os\chgcolor %logoncolor:~0,1%8
	if "%plogonsel%"=="%gn%" Echo.%minispace% %gn%.Guest                         
	if not "%plogonsel%"=="%gn%" (
		echo.%minispace% %plogonsel%.!uu%plogonsel%!                       
	)
) else (
echo.%minispace%                   
)
if not "%logoncolor:~0,1%"=="f" (
	if not "%logoncolor:~0,1%"=="F" (
		bin_os\chgcolor %logoncolor:~0,1%f
	) else (
		bin_os\chgcolor %logoncolor:~0,1%0
	)
) else (
	bin_os\chgcolor %logoncolor:~0,1%0
)
if "%logonsel%"=="%gn%" Echo.%minispace% %gn%.Guest                         
if not "%logonsel%"=="%gn%" (
	echo.%minispace% %logonsel%.!uu%logonsel%!                       
)
if %nlogonsel% GTR 0 (
	bin_os\chgcolor %logoncolor:~0,1%8
	if "%nlogonsel%"=="%gn%" Echo.%minispace% %gn%.Guest                         
	if not "%nlogonsel%"=="%gn%" (
		if not "!uu%nlogonsel%!"=="" (
			echo.%minispace% %nlogonsel%.!uu%nlogonsel%!                       
		) else (
			echo.%minispace%                   
		)
	)
) else (
echo.%minispace%                   
)
echo.
echo.
echo.
bin_os\chgcolor %logoncolor%
echo %tinyspace%Loading %adname%'s desktop...
set pw=
if "%adno%"=="true" goto start
if %classic%==true goto adminclstart
if %hibernated% EQU true goto setfalse
if "%sos%"=="true" title Saving log_os\log.txt
Echo. Spaces_are_disabled >> log_os\log.txt
if "%nopass%"=="yes" goto aap
if "%sos%"=="true" title Output
if "%sos%"=="true" title Clearing screen
if "%sos%"=="true" title Waiting for input
bg print !logoncolor:~0,1!c "%tinyspace%[Password required]\n"
bg print !logoncolor! "%tinyspace%Enter password:"
set/ppw=
if "%sos%"=="true" title Searching for %pw%
if "%pw%"=="%adminpass%" goto aap
if "%adminpass%"=="" goto rain
echo %tinyspace%Wrong password
bg print !logoncolor! "%tinyspace%Press any key to go back . . . "
pause >nul
if not "%user%"=="" goto start
goto logon

:logoncheck
if "%grgu%"=="true" goto start
goto logon

:setfalse
if "%sos%"=="true" title Setting hibernate as FALSE!
set hibernated=false
goto adminstart

:adminstart321
if "%nopass%"=="yes" goto aap
if %classic%==true goto adminclstart
if %hibernated% EQU true goto setfalse
if "%sos%"=="true" title Saving log_os\log.txt
Echo. Spaces_are_disabled >> log_os\log.txt
if "%sos%"=="true" title Clearing screen
cls
if "%sos%"=="true" title Output
if "%sos%"=="true" title Waiting for user input
Echo.
Echo.
Echo.
Echo. %adname%
Echo. Password required
Echo.
set/ppw=Enter password:
if "%sos%"=="true" title Clearing screen 4 times
cls
cls
cls
cls
if "%sos%"=="true" title Searching for %ppw%
if "%pw%"=="%adminpass%" goto aap
goto wrong

:wrong
cls
Echo.
Echo Wrong password
Echo.
Pause
goto logon

:logonasnew2
if "%noupass%"=="true" goto sn
if "%pp%"=="" goto sn
if "%sos%"=="true" title Searching for errors
if "%sos%"=="true" title Wait a, f***! What is this?
Echo Enter your username:%adname%
if "%sos%"=="true" title Checking for classic logon style
if %classic%==true goto userclpass
if "%sos%"=="true" title Checking for jobnation...
if %hibernated% EQU true goto setfalse2
if "%sos%"=="true" title Clearing screen
cls
if "%sos%"=="true" title Saving log
Echo. Spaces_are_disabled >> log_os\log.txt
if "%sos%"=="true" title Clearing screen
cls
if "%noupass%"=="true" goto sn
if "%sos%"=="true" title Output
Echo.
Echo.
Echo.
Echo:                              %userg%
Echo.                               Enter password
Echo.                              2.Cancel
Echo.
Echo.   S=Shutdown R=Restart
if "%sos%"=="true" title Waiting for user input...
set/pppp=^>                         Password:
if "%sos%"=="true" title Clearing screen 4 times...
cls
cls
cls
cls
if "%sos%"=="true" title Searching for %pppp%
if "%ppp%"=="%pp%" goto sn
if "%ppp%"=="s" goto shutdown
if "%ppp%"=="2" goto logoncheck
if "%ppp%"=="R" goto restart
if "%ppp%"=="r" goto restart
goto wrongnew

:setfalse2
if "%sos%"=="true" title Setting jobnate as false
set hibernated=false
goto logonasnew

:logonasnew
if "%userg%"=="" goto somethingwentwrong
if "!pp!"=="" goto sn
if "%sos%"=="true" title Checking for errors
if "%sos%"=="true" title Clearing screen
color %logoncolor%
cls
title Login screen
Echo.
Echo.%minispace%     %hour%:%min%
Echo.
Echo.%blankspace%                                                
Echo.%blankspace%                                                
Echo.%blankspace%     
if %plogonsel% GTR 0 (
	bin_os\chgcolor %logoncolor:~0,1%8
	if "%plogonsel%"=="%gn%" Echo.%minispace% %gn%.Guest                         
	if not "%plogonsel%"=="%gn%" (
		echo.%minispace% %plogonsel%.!uu%plogonsel%!                       
	)
) else (
echo.%minispace%                   
)
if not "%logoncolor:~0,1%"=="f" (
	if not "%logoncolor:~0,1%"=="F" (
		bin_os\chgcolor %logoncolor:~0,1%f
	) else (
		bin_os\chgcolor %logoncolor:~0,1%0
	)
) else (
	bin_os\chgcolor %logoncolor:~0,1%0
)
if "%logonsel%"=="%gn%" Echo.%minispace% %gn%.Guest                         
if not "%logonsel%"=="%gn%" (
	echo.%minispace% %logonsel%.!uu%logonsel%!                       
)
if %nlogonsel% GTR 0 (
	bin_os\chgcolor %logoncolor:~0,1%8
	if "%nlogonsel%"=="%gn%" Echo.%minispace% %gn%.Guest                         
	if not "%nlogonsel%"=="%gn%" (
		if not "!uu%nlogonsel%!"=="" (
			echo.%minispace% %nlogonsel%.!uu%nlogonsel%!                       
		) else (
			echo.%minispace%                   
		)
	)
) else (
echo.%minispace%                   
)
echo.
echo.
echo.
bin_os\chgcolor %logoncolor%
echo %tinyspace%Loading %userg%'s desktop...
set pw=
if "%adno%"=="true" goto start
if %classic%==true goto userclpass
if %hibernated% EQU true goto setfalse
if "%sos%"=="true" title Saving log_os\log.txt
Echo. Spaces_are_disabled >> log_os\log.txt
if "%nopass%"=="yes" goto aap
if "%sos%"=="true" title Output
if "%sos%"=="true" title Clearing screen
if "%sos%"=="true" title Waiting for input
if "%sos%"=="true" title Checking for classic logon
if %classic%==true goto userclpass
bg print !logoncolor:~0,1!c "%tinyspace%[Password required]\n"
if "%sos%"=="true" title Checking for hibernation
if %hibernated% EQU true goto setfalse2
:logonasneww
if "!pp!"=="" goto sn
if "%sos%"=="true" title Saving log... LUL
Echo. Spaces_are_disabled_ >> log_os\log.txt
if "%sos%"=="true" title Clering screen
bg print !logoncolor! "%tinyspace%Enter password:"
set /p passwd=
if "%passwd%"=="%pp%" set passwd=&goto sn
echo %tinyspace%Wrong password
bg print !logoncolor! "%tinyspace%Press any key to go back . . . "
pause >nul
if not "%user%"=="" goto start
goto logon

:wrongnew
if "%sos%"=="true" title Scanning for errors
if "%sos%"=="true" title Clearing screen
cls
if "%sos%"=="true" title Saving log
Echo. Spaces_are_disabled >> log_os\log.txt
if "%sos%"=="true" title Clearing screen
cls
if "%sos%"=="true" title Output
Echo.
Echo.
Echo.
Echo.                              %adname%
Echo.                               Enter password
Echo.                              2.Cancel
Echo.
Echo.
Echo.   S=Shutdown R=Restart
if "%sos%"=="true" title Waiting for input
set/pppp=^>                         Password:
if "%sos%"=="true" title Clearing screen 4 times...
cls
cls
cls
cls
if "%sos%"=="true" title Searching for %pppp%
if "%ppp%"=="%pp%" goto sn
if "%ppp%"=="s" goto shutdown
if "%ppp%"=="2" goto logoncheck
if "%ppp%"=="R" goto restart
if "%ppp%"=="r" goto restart
if "%sos%"=="true" title Exit... /b 0?
if exist log_os\lgr del log_os\lgr
exit /b 0
goto wrongnew

:classiclogon
if "%sos%"=="true" title Searching for errors
if "%sos%"=="true" title Applying logon color
color %logoncolor%
if "%sos%"=="true" title Clearing screen
if "%constart%"=="true" goto promptusr
cls
if "%sos%"=="true" title Output
Echo.
Echo. %creason%
set creason=
Echo.
Echo To log on you need to enter your name and
Echo password.
Echo.
Echo To shutdown type S , to restart type R
Echo.
if "%sos%"=="true" title Waiting for input...
:promptusr
if exist bin_os\bg.exe bg cursor 1
set /p name=Enter your username:
	if not exist config_user\%adname%.settings (
		set tu=%adname%
		md specific_user\!tu! 2>nul
		md specific_user\!tu!\picture 2>nul
		md specific_user\!tu!\document 2>nul
		md specific_user\!tu!\audio 2>nul
		md specific_user\!tu!\video 2>nul
		@echo.::WARNING>>config_user\!tu!.settings
		@echo.::>>config_user\!tu!.settings
		@echo.::To avoid errors in Log OS, please don't edit this file>>config_user\!tu!.settings
		@echo.::>>config_user\!tu!.settings
		@echo.::Saved at : %date% %time%>>config_user\!tu!.settings
		@echo.adname=!adname%acs%!,>>config_user\!tu!.settings
		@echo.admincol=07,>>config_user\!tu!.settings
		@echo.adminpass=!adminpass%acs%!,>>config_user\!tu!.settings
		@echo.admindescript=!admindescript%acs%!,>>config_user\!tu!.settings
		@echo.type=Administrator,>>config_user\!tu!.settings
	)
	if not exist config_user\%userg%.settings (
		set tu=%userg%
		md specific_user\!tu! 2>nul
		md specific_user\!tu!\picture 2>nul
		md specific_user\!tu!\document 2>nul
		md specific_user\!tu!\audio 2>nul
		md specific_user\!tu!\video 2>nul
		@echo.::WARNING>>config_user\!tu!.settings
		@echo.::>>config_user\!tu!.settings
		@echo.::To avoid errors in Log OS, please don't edit this file>>config_user\!tu!.settings
		@echo.::>>config_user\!tu!.settings
		@echo.::Saved at : %date% %time%>>config_user\!tu!.settings
		@echo.userg=!userg!,>>config_user\!tu!.settings
		@echo.usercolor=07,>>config_user\!tu!.settings
		@echo.pp=!pp!,>>config_user\!tu!.settings
		@echo.userdescription=!userdescription!,>>config_user\!tu!.settings
		@echo.type=Administrator,>>config_user\!tu!.settings
	)
for /f %%a in ('dir /b config_user') do (
	if "%%a"=="!name!.settings" (
		if exist config_user\%name%.settings for /f "eol=: delims=," %%a in (config_user\%name%.settings) do set %%a
	)
)
if exist bin_os\bg.exe bg cursor 0
if "%sos%"=="true" title Searching for %name%
if "%old%"=="false" call :checkadmins
if "%name%"=="%adname%" goto adminclstart
if "%old%"=="false" call :checkuserss
if "%name%"=="%userg%" goto userclpass
if "%name%"=="Guest" goto guestclogon
if "%name%"=="guest" goto guestclogon
if "%name%"=="reload" goto logon
if "%name%"=="c" set classic=false&goto loly
if "%name%"=="C" set classic=false&goto loly
if "%name%"=="t" set creason=%time%&goto classiclogon
if "%name%"=="T" set creason=%time%&goto classiclogon
if "%name%"=="settings" goto logonsetup
if "%name%"=="SETTINGS" goto logonsetup
if "%name%"=="text" goto freetext
if "%name%"=="free text" goto freetext
if "%name%"==" " goto freetext
if "%name%"=="s" goto shutdown
if "%name%"=="r" goto restart
if "%name%"=="S" goto shutdown
if "%name%"=="R" goto restart
if "%name%"=="h" set restore=classiclogon&goto hiber
if "%name%"=="H" set restore=classiclogon&goto hiber
if not "%domain%"=="logos_settings" goto checkdomainuser
:continuelocal
if ERRORLEVEL 1 (
goto somethingwentwrong
if exist log_os\lgr del log_os\lgr
exit /b 1
)
goto classiclogon

:logonsetup
cls
:lefreshsetup
bin_os\bg.exe locate 0 0
echo.
echo.
echo.
echo.
echo.
echo.
echo.
echo.
echo.
echo.
echo.
echo.
echo.
Echo.                       
Echo.                       
bin_os\bg.exe locate 0 0
Echo.
Echo Logon screen settings
Echo.
Echo 1. Color
Echo Current color: %logoncolor% 
Echo.
Echo 2. Enable classic logon screen (C)
Echo %classic%  
Echo.
Echo 3. Go back
Echo Returns to the login screen
Echo.
Echo Press a number
:numpad
bg kbd
set key=%errorlevel%
if "%key%"=="51" goto logon
if "%key%"=="50" goto clno
if "%key%"=="49" goto colorcode
goto numpad

:clno
if "%classic%"=="true" set classic=false&goto lefreshsetup
if "%classic%"=="false" set classic=true&goto lefreshsetup
set classic=false
goto lefreshsetup

:colorcode
set /p logoncolor=Enter the color code:
color %logoncolor%
goto lefreshsetup

:dn
goto welcome

:fixadnumber
set an=1
if "%logonisen%"=="true" set logonisen=false&goto logon
goto setcommand

:fixgnumber
if "%adno%"=="true" set gn=1&goto checklogong
set gn=2
:checklogong
if "%logonisen%"=="true" set logonisen=false&goto logon
goto setcommand

:adminclstart
if "%sos%"=="true" title Checking if administrator is disabled
if %adno% EQU true goto classiclogon
if "%nopass%"=="yes" goto aap
if "%sos%"=="true" title Waiting for user input...
if exist bin_os\bg.exe bg cursor 1
set /p cpass=Enter your password:
if exist bin_os\bg.exe bg cursor 0
if "%sos%"=="true" title Checking input..
if "%cpass%"=="%adminpass%" goto aap
if ERRORLEVEL 1 (
goto somethingwentwrong
)
set creason=Password you entered was incorrect.
goto logon

:userclpass
set cpass=bwring123
if "%noupass%"=="true" goto sn
if exist bin_os\bg.exe bg cursor 1
set /p cpass=Enter your password:
if exist bin_os\bg.exe bg cursor 0
if "%cpass%"=="%pp%" goto sn
if ERRORLEVEL 1 (
goto somethingwentwrong
)
set creason=Password you entered was incorrect.
goto logon

:guestclogon
if %noguest% EQU true goto classiclogon
goto lg

:aap
if "%constart%"=="true" Echo Setting variables
if not "%alogon%"=="setupnow" cls
if "%adno%"=="true" goto logon
set randomm=%random%
set pq=%adminpass%
set qin=true
set logontime=%time%
set fastload=true
if exist log_os\Logonscreen del log_os\Logonscreen
set user=%adname%
if "%nopass%"=="no" set pass=You have password
if "%nopass%"=="yes" set pass=You have no password
set description=%admindescript%
if "%hibernated%"=="true" goto lockscreen
goto welcome

:oldwelcome
mode %screen_w%,%screen_h%
color 07
cls
Echo.
Echo.
Echo.
Echo.               Welcome %user%!
Echo.
Echo.        Loading your personal settings
Echo.
if "%user%"=="%domainusername%" Echo.   Preparing settings from local network...
if "%user%" NEQ "%domainusername%" Echo.
Echo.
Echo.
goto return
:welcome
if "%rndcolor%"=="" set rndcolor=07
set returncmd=no
set sel=1
if exist log_os\terminate del log_os\terminate
if "%sounded%"=="true" taskkill /F /IM bg.exe 2>nul&start /B bg play specific_os\root\audio\Startup.wav&bg sleep 100
if "%live%"=="true" goto start
if "%constart%"=="true" Echo Saving settings...
set fiber=true
if "%constart%"=="true" goto return
set qin=true
cd "%ld%"
cd %ld%
cd "%ld%"
if "%description%"=="" title Welcome %user% to %OSname%
if "%slmk%"=="lockscreen" set slmk=&goto start
if "%now%"=="true" set now=sklm&goto start
set hibernated=false
if exist log_os\Logonscreen del log_os\Logonscreen
if "%alogon%"=="setupnow" goto skplolthings
if not "%fullscreen%"=="true" mode %screen_w%,%screen_h%
color 0F
if "%constart%"=="true" goto gskipcls
if not "%alogon%"=="setupnow" cls
:gskipcls
if "%now%"=="true" goto setup
if "%alogon%"=="true" goto return
if "%slogo%"=="no" goto oldwelcome
set alogon=
:return
set gp32=true
if "%live%"=="true" goto skpsavingstart
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
if "%sos%"=="true" title Saving date
:skplolthings
goto start
:checkansavedomain
if "%domain%"=="" goto :eof
if exist %domain% cd %domain%
if exist "%domain%" cd "%domain%"
@echo domainusername=%user%,>>a%domainname%.cmd
@echo domainpassword=%domainpassword%,>>a%domainname%.cmd
@echo domaincolor=%rndcolor%,>>a%domainname%.cmd
@echo domaindescription=%domaindescription%,>>a%domainname%.cmd
if exist %ld% cd %ld%
if exist "%ld%" cd "%ld%"
goto :eof
:skpsavingstart
:start
set /a apcnt=1
if not exist apps_os goto oopsieerror
for /f "delims=" %%a in ('dir /b apps_os') do (
set "temp=%%a"
set "apps!apcnt!=!temp:.bat=!"
set /a apcnt+=1
)
if not exist apps_user md apps_user
for /f "delims=" %%a in ('dir /b apps_user') do (
set "temp=%%a"
set "apps!apcnt!=!temp:.bat=!"
set /a apcnt+=1
)
set /a aps=1
set selapp=!apps%aps%!
if "%setup%"=="true" goto setup1
set "gui="
if "%returncmd%"=="yes" goto setcommand
@echo.>>log_user\This_is_your_desktop
if "%quickstart%"=="true" del log_os\log.txt&@echo.>>log_os\Shutdown&del log_user\This_is_your_desktop&@echo. Boot kernel flashed&if exist log_os\lgr del log_os\lgr&exit
if not "%now%"=="sklm" set now=false
if "%user%"=="%adname%" set rndcolor=%admincol%
if "%sos%"=="true" title Deleting log_os\log.txt
if exist log_os\log.txt del log_os\log.txt
if "%sos%"=="true" title Deleting any other logs
if exist log_user\Settings_are_here del log_user\Settings_are_here
if "%sos%"=="true" title Creating desktop log
@Echo. Do anything here >> log_user\This_is_your_desktop
if "%sos%"=="true" title Applying color
Color %rndcolor%
if "%sos%"=="true" title Resizing window
if "%constart%"=="true" goto bbqskip
if not "%fullscreen%"=="true" mode %screen_w%,%screen_h%
:bbqskip
if "%skggggp%"=="yes" goto iamggggg
if "%logontime%"=="" goto sysprompt
if exist log_os\terminate del log_os\terminate
if exist log_user\command.log set /p answer=<log_user\command.log
if exist log_user\command.log del log_user\command.log&goto anywaydot
if exist log_user\return.log set /p answer=<log_user\return.log
if exist log_user\return.log del log_user\return.log&goto anywaydot
if exist log_user\LOGOUT.LOG del log_user\LOGOUT.LOG&goto logdinglogon
if not exist log_os\LogOS_is_running @echo.%osname% is running>log_os\LogOS_is_running
if exist config_os\de.setting set /p answer=<config_os\de.setting&set startscript=true&goto anywaydot
if exist config_os\de.setting (
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
)
cls
:iamggggg
if "%constart%"=="true" goto launchstart
set now=
set grgu=
if "%sos%"=="true" title Showing desktop
:newtxt
set hour=%time:~0,2%
if "%hour:~0,1%" == " " set hour=0%hour:~1,1%
set min=%time:~3,2%
if "%min:~0,1%" == " " set min=0%min:~1,1%
set secs=%time:~6,2%
if "%secs:~0,1%" == " " set secs=0%secs:~1,1%
set "restore="
if "%oldstart%"=="" set oldstart=false
if not "%user%"=="" bg cursor 0
bin_os\bg.exe locate 0 0
Echo.%tinyspace% 
if not "%user%"=="" (
Echo.  %user%                                              
Echo.  %description%                                       
if not "%description%"=="" Echo.%tinyspace% 
Echo. Your lucky number is : %randomm%                            
Echo. LogOS was started at : %ld%                            
Echo. Current date : %date%                                      
Echo. Current time : %hour%:%min%:%secs%                               
) else (
Echo.  root
Echo.
Echo. 
Echo.
echo.
)
if "!oldstart!"=="true" echo.&goto launchstart
::if "%scroll%"=="yes" Echo. Scroll lock                  Press ? for commands                     
if "%scroll%"=="no" Echo.                              Press ? for commands                     
if "%sel%"=="2" echo.                                
if "%sel%"=="2" echo.      Run      ^<      Setup      ^>   Log out    
if "%sel%"=="2" echo.                                
if "%sel%"=="3" echo.                                
if "%sel%"=="3" echo.     Setup     ^<     Log out     ^>   Shut down  
if "%sel%"=="3" echo.                                
if "%sel%"=="1" echo.                               
if "%sel%"=="1" echo.     About     ^<       Run       ^>    Setup     
if "%sel%"=="1" echo.                                
if "%sel%"=="4" echo.                       / \      
if "%sel%"=="4" echo.    Log out    ^<    Shut down    ^>     Apps   
if "%sel%"=="4" echo.                       \ /      
if "%sel%"=="5" echo.                       / \      
if "%sel%"=="5" echo.   Shut down   ^<   Choose apps   ^>    Profile
if "%sel%"=="5" echo.                       \ /      
if "%sel%"=="6" echo.                                
if "%sel%"=="6" echo.     Apps      ^<     Profile     ^>    Command   
if "%sel%"=="6" echo.                                
if "%sel%"=="7" echo.                                
if "%sel%"=="7" echo.    Profile    ^<     Command     ^>     About    
if "%sel%"=="7" echo.                                
if "%sel%"=="8" echo.                                
if "%sel%"=="8" echo.    Command    ^<      About      ^>      Run     
if "%sel%"=="8" echo.                                
if "%sel%"=="9" echo.                       / \      
if "%sel%"=="9" echo.    Log out    ^<     Restart     ^>     Apps   
if "%sel%"=="9" echo.                       \ /      
if "%sel%"=="10" echo.                       / \      
if "%sel%"=="10" echo.    Log out    ^<    Hibernate    ^>     Apps   
if "%sel%"=="10" echo.                       \ /      
if "%sel%"=="11" echo.                       / \      
if "%sel%"=="11" echo.    Log out    ^<      Sleep      ^>     Apps   
if "%sel%"=="11" echo.                       \ /      
if "%sel%"=="12" echo.                       / \      
if "%sel%"=="12" echo.    Log out    ^<     Hotboot     ^>     Apps   
if "%sel%"=="12" echo.                       \ /      
if "%sel%"=="13" echo.                       / \      
if "%sel%"=="13" echo.    Log out    ^<     Recover     ^>     Apps   
if "%sel%"=="13" echo.                       \ /      
echo.
if "%sel%"=="5" echo. Selected app: !selapp!                                
if not "%sel%"=="5" echo.                                               
set /a vnum=%vnum%+1
if "%vnum%"=="300" call :screensave&cls
color %rndcolor%
if not "%user%"=="" title %description%
if "%user%"=="" title Welcome %user% to %OSname%
if "%sos%"=="true" title Waiting for user input...
if "%fiber%"=="true" call :savesetup
set fiber=
:skipfiber
if "%adminpass%"=="" goto rain
ping localhost -n 1 >nul
if not exist config_os\%OSname%.settings call :savesetup
if "%hibernated%"=="true" del log_os\Shutdown

bg _kbd
set key=%errorlevel%
if "%key%"=="335" set "vnum="&goto arrowdown
if "%key%"=="332" set "vnum="&goto downsel
if "%key%"=="330" set "vnum="&goto upsel
if "%key%"=="327" set "vnum="&goto arrowup
if "%key%"=="63" set "vnum="&goto help
if "%key%"=="13" set "vnum="&goto checksel
if not "%key%"=="0" set "vnum="
if "%out%"=="1" set scroll=yes
if "%out%"=="0" set scroll=no
bin_os\bg.exe locate 0 0
goto newtxt


:downsel
set /a sel=%sel%+1
if "%sel%"=="4" goto checkpr
if "%sel%"=="9" set sel=5
if "%sel%"=="10" set sel=5
if "%sel%"=="11" set sel=5
if "%sel%"=="12" set sel=5
if "%sel%"=="13" set sel=5
if !sel! GTR 13 goto illegalaction
if !sel! LSS 1 goto illegalaction
bin_os\bg.exe locate 0 0
goto newtxt

:changeappdown
set /a aps+=1
set /a upcnt=!apcnt!+1
if !aps! GTR !upcnt! set /a aps=1
set "selapp=!apps%aps%!"
if "!selapp!"=="" goto changeappdown
goto newtxt

:changeappup
set /a aps=%aps%-1
set /a upcnt=1
set /a dpcnt=!apcnt!
if !aps! LEQ !upcnt! set /a aps=!dpcnt!
set "selapp=!apps%aps%!"
if "!selapp!"=="" goto changeappup
goto newtxt

:upsel
set /a sel=%sel%-1
if "%sel%"=="4" goto checkprup
if "%sel%"=="0" set sel=8
if "%sel%"=="9" set sel=3
if "%sel%"=="10" set sel=3
if "%sel%"=="11" set sel=3
if "%sel%"=="12" set sel=3
if "%sel%"=="13" set sel=3
if !sel! GTR 13 goto illegalaction
if !sel! LSS 1 goto illegalaction
bin_os\bg.exe locate 0 0
goto newtxt

:arrowup
if "%sel%"=="5" goto changeappup
if "%sel%"=="4" set sel=13&goto skabaduu
if "%sel%"=="13" set sel=12&goto skabaduu
if "%sel%"=="12" set sel=11&goto skabaduu
if "%sel%"=="11" set sel=10&goto skabaduu
if "%sel%"=="10" set sel=9&goto skabaduu
if "%sel%"=="9" set sel=4&goto skabaduu
goto start
:skabaduu
bin_os\bg.exe locate 0 0
goto newtxt
:arrowdown
if "%sel%"=="5" goto changeappdown
if "%sel%"=="4" set sel=9&goto skabaduu2
if "%sel%"=="9" set sel=10&goto skabaduu2
if "%sel%"=="10" set sel=11&goto skabaduu2
if "%sel%"=="11" set sel=12&goto skabaduu2
if "%sel%"=="12" set sel=13&goto skabaduu2
if "%sel%"=="13" set sel=4&goto skabaduu2
goto start
:skabaduu2
bin_os\bg.exe locate 0 0
goto newtxt
:checkpr
if "%nopr%"=="yes" set sel=5
bin_os\bg.exe locate 0 0
goto newtxt

:checkprup
if "%nopr%"=="yes" set sel=3
bin_os\bg.exe locate 0 0
goto newtxt

:checksel
bg cursor 1
if "%sel%"=="1" goto launchstart
if "%sel%"=="2" goto setup
if "%sel%"=="3" goto logdinglogon
if "%sel%"=="4" goto shutdown
if "%sel%"=="5" set answer=!selapp!&goto anywaydot
if "%sel%"=="6" goto aboutme
if "%sel%"=="7" goto eCMD
if "%sel%"=="8" goto about
if "%sel%"=="9" goto restart
if "%sel%"=="10" goto hiber
if "%sel%"=="11" goto hybridsleep
if "%sel%"=="12" goto hoting
if "%sel%"=="13" goto recoverboot
bin_os\bg.exe locate 0 0
goto start

:aboutme
cls
Echo.
Echo User info
Echo.
if "%user%"=="" set falcon=fal&goto lsa
Echo Name: %user%
:usertype
if "%user%"=="%adname%" Echo Type: Administrator&goto viewtheme
if "%user%"=="%userg%" Echo Type: Standard user&goto viewtheme
if "%user%"=="Guest" Echo Type: Guest&goto viewtheme
:lsa
Echo Local system account
:viewtheme
Echo Theme: %rndcolor%
Pause
goto start
:launchstart
if "%compat2%"=="true" set compat1=true
if exist bin_os\bg.exe bg cursor 1
if "%constart%"=="false" set/panswer=^>           Enter file to launch:
if "%constart%"=="true" set/panswer=Enter file to launch:
::that was the easiest bug to ever solve :D
if "%constart%"=="" goto somethingwentwrong
:anywaydot
if exist bin_os\bg.exe bg cursor 0
if "%description%"=="" title Welcome %user% to %OSNAME%
if "%sos%"=="true" title Searching for file...
if "%constart%"=="true" set compat1=true
if "%answer:~-6%"==".ascii" goto viewtheimage
if "%answer:~-4%"==".wav" goto playthatfile
if "%answer:~-4%"==".txt" goto viewthatnote
if exist "apps_os\%answer%.bat" (
if not "%user%"=="" (
cmd /K "apps_os\%answer%.bat"
) else (
cls
echo.
echo This action is not allowed
echo.
echo For security reasons, this account cannot
echo launch ANY external application.
echo.
pause
goto start
)
mode %screen_w%,%screen_h%
if exist log_os\log.txt del log_os\log.txt
if exist log_os\Afterun.Quicksetup (
for /f %%a in (log_os\Afterun.Quicksetup) do set "%%a"
del log_os\Afterun.Quicksetup
)
goto start
)
if not "%answer%"=="%answer:specific_os=%" (
	if not "%user%"=="" (
		cls
		echo.
		echo Access is denied.
		echo Details: 'root' has disabled access to 'specific_os'
		echo for other users.
		echo.
		pause
		goto start
	)
)
if not "%answer%"=="%answer:specific_user=%" (
	if "%answer%"=="%answer:!user!=%" (
		if "%user%"=="%userg%" (
			cls
			echo.
			echo Access is denied.
			echo Details: You are a standard user account, which
			echo means that you can't access other account's
			echo user folder.
			echo.
			pause
			goto start
		) else (
			if "%user%"=="Guest" (
				cls
				echo.
				echo Access is denied.
				echo Details: You are a guest account, meaning
				echo that you can't access other account's user
				echo folder.
				echo.
				pause
				goto start
			)
		)
	)
)
if "%answer%"=="?" goto help
if "%answer%"=="saver" goto screensave
if "%answer%"=="Saver" goto screensave
if "%answer%"=="SAVER" goto screensave
if "%answer%"=="logoff" goto logdinglogon
if "%answer%"=="Logoff" goto logdinglogon
if "%answer%"=="LOGOFF" goto logdinglogon
if "%answer%"=="lock" goto lockscreen
if "%answer%"=="Lock" goto lockscreen
if "%answer%"=="Settings" goto setup
if "%answer%"=="LOCK" goto lockscreen
if "%answer%"=="gedit" goto usercheckrgeditor
if "%answer%"=="gedit" goto usercheckrgeditor
if "%answer%"=="gedit" goto usercheckrgeditor
if "%answer%"=="gedit" goto usercheckrgeditor
if "%answer%"=="Explorer" goto fe
if "%answer%"=="explorer" goto fe
if "%answer%"=="EXPLORER" goto fe
if "%answer%"=="Shutdown" goto shutdown
if "%answer%"=="shutdown" goto shutdown
if "%answer%"=="SHUTDOWN" goto shutdown
if "%answer%"=="about" goto about
if "%answer%"=="About" goto about
if "%answer%"=="ABOUT" goto about
if "%answer%"=="Notes" goto notes
if "%answer%"=="notes" goto notes
if "%answer%"=="NOTES" goto notes
if "%answer%"=="RESTART" goto restart
if "%answer%"=="restart" goto restart
if "%answer%"=="Restart" goto restart
if "%answer%"=="eCMD" goto cmd
if "%answer%"=="ecmd" goto cmd
if "%answer%"=="ECMD" goto cmd
if "%answer%"=="Ecmd" goto cmd
if "%answer%"=="Time" goto time
if "%answer%"=="time" goto time
if "%answer%"=="TIME" goto time
if "%answer%"=="Hibernate" goto hiber
if "%answer%"=="hibernate" goto hiber
if "%answer%"=="HIBERNATE" goto hiber
if "%answer%"=="Standby" goto standby
if "%answer%"=="standby" goto standby
if "%answer%"=="STANDBY" goto standby
if "%answer%"=="Sleep" goto hybridsleep
if "%answer%"=="SLEEP" goto hybridsleep
if "%answer%"=="sleep" goto hybridsleep
if "%answer%"=="diskinfo" goto dsk
if "%answer%"=="Diskinfo" goto dsk
if "%answer%"=="DiskInfo" goto dsk
if "%answer%"=="DISKINFO" goto dsk
if "%answer%"=="ASCIIview" goto asvi
if "%answer%"=="asciiview" goto asvi
if "%answer%"=="ASCIIVIEW" goto asvi
if "%answer%"=="Asciiview" goto asvi
if "%answer%"=="AsciiView" goto asvi
if "%answer%"=="settings" goto setup
if "%answer%"=="SETTINGS" goto setup
if "%answer%"=="svsetting" set restart=true&goto setup
if "%answer%"=="SVSETTING" set restart=true&goto setup
if "%answer%"=="type" goto typetext
if "%answer%"=="Type" goto typetext
if "%answer%"=="TYPE" goto typetext
if "%answer%"=="Fastnote" goto editir
if "%answer%"=="fastnote" goto editir
if "%answer%"=="FASTNOTE" goto editir
if "%answer%"=="hotboot" goto hoting
if "%answer%"=="Hotboot" goto hoting
if "%answer%"=="HotBoot" goto hoting
if "%answer%"=="HOWBOOT" goto hoting
if "%answer%"=="custom" goto customapp
if "%answer%"=="Custom" goto customapp
if "%answer%"=="CUSTOM" goto customapp
if "%answer%"=="recover" goto recoverboot
if "%answer%"=="Recover" set restart=true&goto recoverboot
if "%answer%"=="RECOVER" set restart=true&goto recoverboot
if "%answer%"=="PlayWAV" goto waveplay
if "%answer%"=="playwav" goto waveplay
if "%answer%"=="PLAYWAV" goto waveplay
if "%answer%"=="playWAV" goto waveplay
if "%answer%"=="PlayWAV" goto waveplay
if "%answer%"=="Playwav" goto waveplay
if "%answer%"=="stopwav" @echo.>>log_os\terminate&echo Stopping sound device...&taskkill /F /IM bg.exe >nul 2>nul&ping localhost -n 5 >nul&goto start
if exist "apps_user\%answer%.bat" goto launchlogapp
if "%answer%"=="settings user name" set restart=true&goto name
if "%answer%"=="Settings user name" set restart=true&goto name
if "%answer%"=="SETTINGS USER NAME" set restart=true&goto name
if "%answer%"=="settings color" goto recolor
if "%answer%"=="Settings color" goto recolor
set grgu=true
set now=true
if "%answer%"=="switch Guest" set userswitch=lg&goto snw
if "%answer%"=="switch %adname%" set userswitch=adminstart&goto snw
if "%answer%"=="switch %userg%" set userswitch=logonasnew&goto snw
set now=
set grgu=
if not "%user%"=="" goto aifostart
:aifostart
if "%capps%"=="yes" goto help
if "%answer%"=="edit SYSTEM" goto systemeditor
if "%answer%"=="SETTINGS COLOR" goto recolor
if "%answer%"=="settings factory reset" goto factory
if "%answer%"=="Settings factory reset" goto factory
if "%answer%"=="SETTINGS FACTORY RESET" goto factory
if "%answer%"=="settings autoreset -enable" set restart=true&goto arsf
if "%answer%"=="settings autoreset -disable" set restart=true&goto arst
if "%answer%"=="Settings autoreset -enable" set restart=true&goto arsf
if "%answer%"=="Settings autoreset -disable" set restart=true&goto arst
if "%answer%"=="SETTINGS AUTORESET -ENABLE" set restart=true&goto arsf
if "%answer%"=="SETTINGS AUTORESET -DISABLE" set restart=true&goto arst
if "%answer%"=="settings user" mode %screen_w%,%screen_h%&set restart=true&goto usersettings
if "%answer%"=="Settings user" mode %screen_w%,%screen_h%&set restart=true&goto usersettings
if "%answer%"=="SETTINGS USER" mode %screen_w%,%screen_h%&set restart=true&goto usersettings
if "%answer%"=="settings user disable administrator -true" set restart=true&goto diad
if "%answer%"=="settings user disable administrator -false" set restart=true&goto enad
if "%answer%"=="Settings user disable administrator -true" set restart=true&goto diad
if "%answer%"=="Settings user disable administrator -false" set restart=true&goto enad
if "%answer%"=="SETTINGS USER DISABLE ADMINISTRATOR -TRUE" set restart=true&goto diad
if "%answer%"=="SETTINGS USER DISABLE ADMINISTRATOR -FALSE" set restart=true&goto enad
if "%answer%"=="settings user disable guest -true" set restart=true&goto engu
if "%answer%"=="settings user disable guest -false" set restart=true&goto digu
if "%answer%"=="Settings user disable guest -true" set restart=true&goto engu
if "%answer%"=="Settings user disable guest -false" set restart=true&goto digu
if "%answer%"=="SETTINGS USER DISABLE GUEST -TRUE" set restart=true&goto engu
if "%answer%"=="SETTINGS USER DISABLE GUEST -FALSE" set restart=true&goto digu
if "%answer%"=="Settings user autologon -true" set restart=true&goto enablealog
if "%answer%"=="SETTINGS USER AUTOLOGON -TRUE" set restart=true&goto enablealog
if "%answer%"=="settings user autologon -true" set restart=true&goto enablealog
if "%answer%"=="Settings user autologon -false" set restart=true&goto disablealog
if "%answer%"=="SETTINGS USER AUTOLOGON -FALSE" set restart=true&goto disablealog
if "%answer%"=="settings user autologon -false" set restart=true&goto disablealog
if "%answer%"=="settings user autologon" set restart=true&goto alog
if "%answer%"=="Settings user autologon" set restart=true&goto alog
if "%answer%"=="SETTINGS USER AUTOLOGON" set restart=true&goto alog
if "%answer%"=="settings fullscreen" set restart=true&goto setfscreen
if "%answer%"=="Settings fullscreen" set restart=true&goto setfscreen
if "%answer%"=="SETTINGS FULLSCREEN" set restart=true&goto setfscreen
if "%answer%"=="SETTINGS FULLSCREEN -ENABLE" set restart=true&goto enablesf
if "%answer%"=="Settings fullscreen -enable" set restart=true&goto enablesf
if "%answer%"=="settings fullscreen -enable" set restart=true&goto enablesf
if "%answer%"=="SETTINGS FULLSCREEN -DISABLE" set restart=true&goto disablesf
if "%answer%"=="Settings fullscreen -disable" set restart=true&goto disablesf
if "%answer%"=="settings fullscreen -disable" set restart=true&goto disablesf
if "%answer%"=="SETTINGS SOS -ENABLE" goto enablesos
if "%answer%"=="Settings sos -enable" goto enablesos
if "%answer%"=="settings sos -enable" goto enablesos
if "%answer%"=="SETTINGS SOS -DISABLE" goto disablesos
if "%answer%"=="Settings sos -disable" goto disablesos
if "%answer%"=="settings sos -disable" goto disablesos
if "%answer%"=="settings user delete user" goto deluserg
if "%answer%"=="settings ?" goto helpsetup
if "%answer%"=="logos_settings" goto start
if "%answer%"=="config_os\%OSname%.settings" goto start
if "%answer%"=="config_os\%OSname%.settings" goto start
if exist %answer%.cs cls&echo eCMD version 1.2&set cfile=%answer%.cs&set endscript=true&call :knowncfile&goto start
if not "%answer%"=="%answer:.cs=%" cls&echo eCMD version 1.2&set cfile=%answer%&set endscript=true&call :knowncfile&goto start
if exist %answer%.bat goto launchbat
if exist %answer%.exe goto launchexe
if exist %answer%.cmd goto launchcmd
if exist %answer%.com goto launchcom
if exist %answer% goto launchapp1
if not "%restore%"=="" goto %restore%
if "%returncmd%"=="yes" goto setcommandfinish
if "%constart%"=="true" goto start
:commanderror
cls
Echo.
if not "!answer:~0,6!"=="switch" Echo. Command not found.
if "!answer:~0,6!"=="switch" Echo. Specified account does not exist.
Echo.
Pause
goto start

:warninglog
Echo.
Echo Running LogOS inside of LogOS can cause serious
Echo slowdowns to the command prompt and also
Echo cause 'Input too long' errors. Are you sure
Echo you want to continue?
choice
if errorlevel 2 goto start
if errorlevel 1 goto anywaydot
goto start
:launchapp1
cmd /K @%answer%
echo off
goto start

:launchcom
start "" /b %answer%.com
@echo off
goto start

:launchexe
start "" /b %answer%.exe
@echo off
goto start

:launchcmd
start "" /b %answer%.cmd
@echo off
goto start

:launchbat
start "" /b %answer%.bat
@echo off
goto start


:playthatfile
set file=%answer%
if not exist boot_os\Sound.bat call :createsound
if exist log_os\terminate del log_os\terminate
start /b boot_os\Sound.bat
mode %screen_w%,%screen_h%
if exist "%file%" @echo.%file%>>play&goto play
if exist "%file%.wav" goto ready
goto commanderror

:snw
if "%userswitch%"=="lg" goto guestcheck
if "%userswitch%"=="adminstart" goto adcheck
if "%userswitch%"=="logonasnew" goto ugcheck
:csnw
goto %userswitch%

:guestcheck
if "%noguest%"=="true" goto aifostart
goto csnw

:adcheck
if "%adno%"=="true" goto aifostart
goto csnw

:ugcheck
if "%userg%"=="" goto aifostart
goto csnw

:sysprompt
set skggggp=yes
goto start

:systemeditor
if not "%PROCESSOR_ARCHITECTURE%"=="x86" (
cls
echo.
echo 32-bit operating system required
echo to use edit. Launching notepad
echo windows instead...
Echo.
pause
)
cls
Echo.
Echo System editor.
Echo.
Echo Loading...
Echo. LogOS editor
if not "%now%"=="sklm" ping localhost -n 1 >nul
if "%PROCESSOR_ARCHITECTURE%"=="x86" edit %0
if not "%PROCESSOR_ARCHITECTURE%"=="x86" notepad "%~dp0%~nx0"
Echo. LogOS settings editor
if not "%now%"=="sklm" ping localhost -n 1 >nul
if "%PROCESSOR_ARCHITECTURE%"=="x86" edit config_os\%OSname%.settings
if not "%PROCESSOR_ARCHITECTURE%"=="x86" notepad "%~dp0config_os\%OSname%.settings"
Echo. LogOS flasher editor
if not "%now%"=="sklm" ping localhost -n 1 >nul
if "%PROCESSOR_ARCHITECTURE%"=="x86" edit logos_flasher.bat
if not "%PROCESSOR_ARCHITECTURE%"=="x86" notepad logos_flasher.bat
Echo Returning to START
if not "%now%"=="sklm" ping localhost -n 1 >nul
goto start

:help
set fullscreen=true
if "%sos%"=="true" title Deleting desktop log
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if "%sos%"=="true" title Clearing screen
if "%description%"=="" title Welcome %user% to %OSname%
cls
if "%sos%"=="true" title Waiting for user input.
Echo.           Internal commands
Echo.
Echo. ?          = Shows avaible commands
Echo. Settings   = Shows setup for batch file
Echo. About      = Information about batch file
Echo. Logoff     = Logs off
Echo. Restart    = Shutdowns and starts OS again
if "%fullscreen%"=="true" goto nextsceenhelp
Echo. Shutdown   = Closes batch file
Echo.
Pause>nul
if "%sos%"=="true" title Clearing screen...
cls
if "%sos%"=="true" title Waiting for user input..
Echo.           Internal commands
Echo.
:nextsceenhelp
Echo. Notes      = Manage your notes
Echo. Press      = Last Viewed
Echo. enter
Echo. eCMD       = Starts Extended Command Prompt
Echo. Time       = Shows current time
if "%fullscreen%"=="true" goto nextsceenhelp2
Echo. Shutdown   = Closes batch file
Echo.
Pause>nul
if "%sos%"=="true" title Clearing screen
cls
if "%sos%"=="true" title Waiting for user input...
Echo.           Internal commands
Echo.
:nextsceenhelp2
Echo. Hibernate  = Saves session and shuts dowm
Echo. Standby    = Takes %OSname% to low power state
Echo. DiskInfo   = Shows info about disks
Echo. Type       = Types a file
Echo. Fastnote   = Quickly make notes
if "%fullscreen%"=="true" goto nextsceenhelp3
Echo. Shutdown   = Closes batch file
Echo.
Pause>nul
cls
if "%sos%"=="true" title Waiting for user input..
Echo.           Internal commands
Echo.
:nextsceenhelp3
Echo. Hotboot    = Reboots system without
Echo.              rebooting batch file.
Echo. Custom     = Manage custom applications
Echo. Recover    = Reboot into recovery
Echo. Sleep      = Takes %OSname% to low power state
Echo.              and saves session to disk.
if "%fullscreen%"=="true" goto nextsceenhelp4
Echo. Shutdown   = Closes batch file
Echo.
Pause>nul
cls
if "%sos%"=="true" title Waiting for user input.
Echo.           Internal commands
Echo.
:nextsceenhelp4
Echo. Lock       = Locks current user account
for /f %%a in ('dir /b apps_os\*.bat') do (
set "temp=%%a"
for /f "delims=" %%b in ('call apps_os\%%a whatis') do set "help=%%b"
set firstletter=!temp:~0,1!
set firstletter=!firstletter:a=A!
set firstletter=!firstletter:b=B!
set firstletter=!firstletter:c=C!
set firstletter=!firstletter:d=D!
set firstletter=!firstletter:e=E!
set firstletter=!firstletter:f=F!
set firstletter=!firstletter:g=G!
set firstletter=!firstletter:h=H!
set firstletter=!firstletter:i=I!
set firstletter=!firstletter:j=J!
set firstletter=!firstletter:k=K!
set firstletter=!firstletter:l=L!
set firstletter=!firstletter:m=M!
set firstletter=!firstletter:n=N!
set firstletter=!firstletter:o=O!
set firstletter=!firstletter:p=P!
set firstletter=!firstletter:q=Q!
set firstletter=!firstletter:r=R!
set firstletter=!firstletter:s=S!
set firstletter=!firstletter:t=T!
set firstletter=!firstletter:u=U!
set firstletter=!firstletter:v=V!
set firstletter=!firstletter:w=W!
set firstletter=!firstletter:x=X!
set firstletter=!firstletter:y=Y!
set firstletter=!firstletter:z=Z!
set "temp=!firstletter!!temp:~1!"
echo. !temp:.bat=! ^(!help!^)
)
Echo. Shutdown   = Closes batch file
Pause>nul
if "%sos%"=="true" title Returning to start
goto start

:usercheckrgeditor
if "%user%"=="Guest" Echo Access denined&goto start
if "%user%"=="%userg%" Echo Only administrator can perform this action
if "%user%"=="%adname%" goto geditor
Echo Anonymous, please log on.
goto start

:helpsetup
if "%sos%"=="true" title Clearing screen
cls
if "%sos%"=="true" title Waiting for user input...
Echo.          Settings [Command]
Echo.
Echo. Set up LogOS.
Echo.
Echo. Settings [setting/user] [user setting]
Echo. [-true/-false] [-enable/-disable]
Echo.
Echo. [setting]          - Enter quick setting to
Echo.                      set up
if "%sos%"=="true" title Waiting for user input..
if "%fullscreen%" NEQ "true" pause
if "%fullscreen%" NEQ "true" cls
if "%sos%"=="true" title Checking, is fullscreen enabled...
Echo. [user]             - Need to enter it if you
Echo.                      want to set up users.
Echo. [user setting]     - Enter user setting to set up
Echo. [-true/-false]     - Enable or disable selected
Echo.                      setting.
Echo. [-enable/-disable] - Enable or disable setting
Echo.
Echo. Examples:
if "%sos%"=="true" title Waiting for user input.
if "%fullscreen%" NEQ "true" pause
if "%fullscreen%" NEQ "true" cls
if "%sos%"=="true" title Checking, is fullscreen enabled...
Echo.
Echo. Settings user delete user
Echo. Settings fullscreen -disable
Echo. Settings factory reset
Echo.
Echo. Entering "Settings" without any values,
Echo. will start settings app.
Echo.
Echo.
if "%sos%"=="true" title Waiting for user input..
Pause
if "%sos%"=="true" title Clearing screen
cls
if "%sos%"=="true" title Returning to start
goto start

:recoverboot
if "%sos%"=="true" title Checking for recovery access
if "%recoveraccess%"=="no" goto start
if "%sos%"=="true" title Setting hibernation to true
set hibernated=false
if "%sos%"=="true" title Deleting log_os\log.txt
if exist log_os\log.txt del log_os\log.txt
if "%sos%"=="true" title Saving log_os\log.txt
if not "%live%"=="true" Echo. Restart error >>log_os\log.txt
if "%sos%"=="true" title Deleting logs...
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\log.txt del log_os\log.txt
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if "%sos%"=="true" title Rebooting with recovery command...
if "%sos%"=="true" title Setting recovery
set recover=true
if "%sos%"=="true" title Setting recovery reason
set reason=Desktop
if "%sos%"=="true" title Saving successfull shutdown log
@echo Shutdown was successfull>>log_os\Shutdown
if "%sos%"=="true" title Hotbooting...
goto logos

:hybridsleep
if "%sos%"=="true" title Clearing screen...
if "%sos%"=="true" title Changing color to 07
color 07
ping localhost -n 1 >nul
color 08
ping localhost -n 1 >nul
cls
ping localhost -n 1 >nul
if "%live%"=="true" goto sleepnow
if "%live%"=="yes" goto sleepnow
if "%sos%"=="true" title Deleting %OSname% settings
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
if "%sos%"=="true" title Saving date
echo ::WARNING!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
::
if "%sos%"=="true" title Saving username

if "%sos%"=="true" title Saving user number
if "%sos%"=="true" title Saving incorrect password message
@echo ip=%ip%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving default color
@echo rndcolor=%rndcolor%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving admin password
@echo adminpass=%adminpass%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving plugins



if "%sos%"=="true" title Saving user description

if "%sos%"=="true" title Setting hibernation as true
@echo hibernated=true,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving restore variable...
if "%user%"=="%userg%" goto notadminsf3333
if "%user%"=="Guest" goto notadminorusersf3333
if "%user%"=="%domainusername%" goto domainsaver3333
goto adminyessf3333
:notadminsf3333
goto adminyessf3333
:notadminorusersf3333
goto adminyessf3333
:domainsaver3333
@echo restore=dn,>>config_os\%OSname%.settings
@echo restoreloader=%domainname%.cmd,>>config_os\%OSname%.settings
:adminyessf3333
if "%sos%"=="true" title Setting time
set t=
if "%sos%"=="true" title Saving user color

if "%sos%"=="true" title Saving admin color
@echo admincol=%admincol%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving guest number
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving factory setting
@echo factory=no,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving guest setting
@echo noguest=%noguest%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving logon color
@echo logoncolor=%logoncolor%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving autoreset variable
@echo autoreset=%autoreset%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving admin name
@echo adname=%adname%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving admin setting
@echo adno=%adno%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving admin description
@echo admindescript=%admindescript%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving classic logon setting
@echo classic=%classic%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving autologon setting
@echo autologon=%autologon%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving autologon name
@echo loginname=%loginname%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving compatibility
@echo compatibility=%compatibility%,>>config_os\%OSname%.settings
::@echo resolution=%resolution%,>>config_os\%OSname%.settings
@echo constart=%constart%,>>config_os\%OSname%.settings
@echo sounded=%sounded%,>>config_os\%OSname%.settings
@echo oldstart=%oldstart%,>> config_os\%OSname%.settings
@echo.::Ends sound driver>>log_os\terminate
taskkill /F /IM bg.exe 2>nul
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
:sleepnow
if "%sos%"=="true" title Clearing screen
cls
if "%sos%"=="true" title Preparing to standby
bg cursor 0
if not "%now%"=="sklm" ping localhost -n 1 >nul
if not "%now%"=="sklm" ping localhost -n 2 >nul
cls
Echo.
Echo.
Echo.
if "%sos%"=="true" title Waiting for user input...
Pause>nul
if "%sos%"=="true" title Resuming %OSname%
goto start

:dsk
if "%sos%"=="true" title Clearing screen
cls
if "%sos%"=="true" title Executing DPIC
if "%compat%"=="yes" pause&goto start
DPIC
if "%sos%"=="true" title Output
echo.
if "%sos%"=="true" title Waiting for user input
Pause
if "%sos%"=="true" title Returning to start
goto start

:editir
if "%sos%"=="true" title Clearing screen
cls
if "%sos%"=="true" title Waiting for user input...
set /p answer=Save file to:
if "%sos%"=="true" title Clearing screen
cls
if "%sos%"=="true" title Waiting for user input
set /p text="%answer%"^>
set /p filename=Enter file name:
if "%sos%"=="true" title Output
Echo Saving...
if "%sos%"=="true" title Saving %filename%
Echo %text%,>>"%answer%\%filename%"
if "%sos%"=="true" title Waiting for user input
Echo Saved :^)
Pause
if "%sos%"=="true" title Returning start...
goto start

:time
cls
:timed
title %time%
bin_os\bg.exe locate 0 0
Echo.
Echo Current time:
Echo.
time /t
if "%compat%"=="yes" pause&goto start
Echo.
Echo.
Echo.
Echo.
bg sleep 10
bg _kbd
if "%key%"=="120" title %description%&goto start
if "%key%"=="99" cls&time&cls
if "%key%"=="88" title %description%&goto start
if "%key%"=="67" cls&time&cls
if "%key%"=="43" goto somethingwentwrong
Echo Press X to exit or C to change time
goto timed

:setup
color %rndcolor%
if "%constart%"=="true" goto iamnotaniti
if "%live%"=="true" goto IAMANIDIOT
if "%now%"=="sklm" goto IAMANIDIOT
set now=false
Echo Settings are here >> log_user\Settings_are_here
:IAMANIDIOT
if "%restart%"=="true" set restart=&goto start
if "%sos%"=="true" title Resizing window
if not "%fullscreen%"=="true" mode %screen_w%,%screen_h%
if "%sos%"=="true" title Clearing screen
cls
if "%sos%"=="true" title Output
Echo.
Echo.
Echo.%minispace%  Settings ^(SETUP^)
Echo.
Echo.
if "%user%"=="%adname%" Echo.%tinyspace%1.Color                  2. Factory mode
if "%user%"=="%adname%" Echo.%tinyspace%Color %rndcolor%                 System management options
if not "%user%"=="%adname%" Echo.%tinyspace%1.Color                  2. Factory mode
if not "%user%"=="%adname%" Echo.%tinyspace%Color %rndcolor%                 Administrator required
Echo.             
Echo.%tinyspace%3.Autorestart on errors  4.User account settings
if "%autoreset%"=="true" Echo.%tinyspace%%autoreset%                     Manage user accounts
if "%autoreset%"=="false" Echo.%tinyspace%%autoreset%                    Manage user accounts
Echo.
Echo.%tinyspace%5. Micellaneous options  6. Back to start
Echo.%tinyspace%Uncategorized settings   Goes back to desktop
:iamnotaniti
if "%constart%"=="true" echo 1. Color (%rndcolor%)
if "%constart%"=="true" echo 2. Factory mode
if "%constart%"=="true" echo 3. Autorestart on errrs (%autoreset%)
if "%constart%"=="true" echo 4. User account settings
if "%constart%"=="true" echo 5. Miscellaneous options
if "%constart%"=="true" echo 6. Go back to the start screen
Echo.
if "%user%"=="" Echo.%tinyspace%Settings will not be saved
if "%user%"=="" Echo.%tinyspace%Reason: Static account
if "%live%"=="true" Echo.%tinyspace%Settings will not be saved
if "%live%"=="true" Echo.%tinyspace%Reason: Live mode
if not "%user%"=="%adname%" Echo.%tinyspace%Some settings are managed by
if not "%user%"=="%adname%" Echo.%tinyspace%your administrator.
Echo.
if "%sos%"=="true" title Waiting for user input...
if exist bin_os\bg.exe bg cursor 1
set/panswer= Your selection:
if exist bin_os\bg.exe bg cursor 0
if "%sos%"=="true" title Searching for %answer%
if "%answer%"=="1" set fiber=true&goto recolor
if "%user%"=="%userg%" goto nofusetup
if "%answer%"=="2" set fiber=true&goto recoverboot
:nofusetup
if "%answer%"=="3" set fiber=true&goto ars
if "%answer%"=="4" goto usersettings
if "%answer%"=="5" goto miscsettings
if "%answer%"=="6" goto start
if "%answer%"=="hibernate" set restore=setup&goto hiber
set restore=setup
goto anywaydot
if "%sos%"=="true" title %answer% not found, refreshing
cls
goto s

:miscsettings
cls
if not "%constart%"=="true" (
echo.
echo Miscellaneous options
if not "%user%"=="%adname%" echo.&echo Some settings are managed by your administrator
echo.
echo 1. Play startup sound
echo %sounded%
echo.
echo 2. Use classic start screen
echo %oldstart%
echo.
echo 3. Return to settings
echo Goes back
if not "%user%"=="%adname%" goto skipthatstuffs
echo.
echo 4. Console only mode
echo %constart%
echo.
echo 5. Resolution
echo %screen_w%x%screen_h%
:skipthatstuffs
echo.
)
if "%constart%"=="true"  (
echo.
echo Miscellaneous options
echo.
echo 1. Play startup sound [%sounded%]
echo 2. Use classic start screen [%oldstart%]
echo 3. Return to settings
if not "%user%"=="%adname%" goto skipthatstuffs2
echo 4. Console only mode [%constart%]
echo 5. Resolution [%screen_w%x%screen_h%]
echo.
echo.
)
:skipthatstuffs2
set /p answer=Your selection:
if "%answer%"=="1" set fiber=false&goto setstartep
if "%answer%"=="2" set fiber=false&goto setclassicscreen
if "%answer%"=="3" cls&goto s
if "%user%"=="%adname%" (
if "%answer%"=="4" goto setconstart
if "%answer%"=="5" goto setres
)
goto miscsettings

:setres
cls
echo.
echo Screen resolution (current %screen_w%x%screen_h%)
echo.
echo 1. 150x45
echo 2. 100x45
echo 3. 80x45
echo 4. 100x27
echo 5. 80x27
echo 6. 60x27
echo 7. 80x35
echo.
if not "%constart%"=="true" (
echo Note 1: Some apps may adjust your resolution for more
echo screen space.
echo.
echo Note 2: These resolutions have been verified to work
echo correctly. Do not use other resolution by editing
echo Screen.settings file.
echo.
)
set /p answer=Your selection:
if "%answer%"=="1" set screen_w=150&set screen_h=45&goto applyres
if "%answer%"=="2" set screen_w=100&set screen_h=45&goto applyres
if "%answer%"=="3" set screen_w=80&set screen_h=45&goto applyres
if "%answer%"=="4" set screen_w=100&set screen_h=27&goto applyres
if "%answer%"=="5" set screen_w=80&set screen_h=27&goto applyres
if "%answer%"=="6" set screen_w=60&set screen_h=27&goto applyres
if "%answer%"=="7" set screen_w=80&set screen_h=35&goto applyres
goto setres

:applyres
mode %screen_w%,%screen_h%
set "blankspace="
set "minispace="
set "tinyspace="
set /a space_w=!screen_w!/2-4
set /a minispace_w=!screen_w!/2-10
set /a tinyspace_w=!screen_w!/2-22
for /l %%a in (1 1 !space_w!) do set "blankspace=!blankspace! "
for /l %%a in (1 1 !minispace_w!) do set "minispace=!minispace! "
for /l %%a in (1 1 !tinyspace_w!) do set "tinyspace=!tinyspace! "
set /a blank_h=!screen_h!/2-4
if not "%live%"=="true" (
@echo.::WARNING>config_os\Screen.settings
@echo.::>>config_os\Screen.settings
@echo.::To avoid errors in Log OS, please don't edit this file>>config_os\Screen.settings
@echo.::>>config_os\Screen.settings
@echo.::Updated at: %date% %time%>>config_os\Screen.settings
@echo.::>>config_os\Screen.settings
@echo.screen_w=%screen_w%,>>config_os\Screen.settings
@echo.screen_h=%screen_h%,>>config_os\Screen.settings
)
goto miscsettings

:setconstart
if "%constart%"=="true" set constart=false&goto miscsettings
if "%constart%"=="false" set constart=true&goto miscsettings
set constart=false
goto miscsettings

:setclassicscreen
if "%oldstart%"=="true" set oldstart=false&goto miscsettings
if "%oldstart%"=="false" set oldstart=true&goto miscsettings
set oldstart=false
goto miscsettings

:setstartep
if "%sounded%"=="true" set sounded=false&goto miscsettings
if "%sounded%"=="false" set sounded=true&goto miscsettings
set sounded=true
goto miscsettings

:savesetup
if "%sos%"=="true" title Checking if logged in as an administrator account
if "%user%"=="" goto :eof
if not "%user%"=="%tempfs%" (
if "%adname%"=="%user%" (
	if "%sos%"=="true" title Saving personal settings...
	set tu=!adname!
	@echo.::WARNING>config_user\!adname!.settings
	@echo.::>>config_user\!adname!.settings
	@echo.::To avoid errors in Log OS, please don't edit this file>>config_user\!adname!.settings
	@echo.::>>config_user\!adname!.settings
	@echo.::Saved at : %date% %time%>>config_user\!adname!.settings
	@echo.adname=!adname!,>>config_user\!adname!.settings
	@echo.admincol=!admincol!,>>config_user\!adname!.settings
	@echo.adminpass=!adminpass!,>>config_user\!adname!.settings
	@echo.admindescript=!admindescript!,>>config_user\!adname!.settings
	@echo.type=Administrator,>>config_user\!adname!.settings
)
if "%sos%"=="true" title Checking if logged in as a standard user account
if "%userg%"=="%user%" (
	if "%sos%"=="true" title Saving personal settings...
	@echo.::WARNING>config_user\!userg!.settings
	@echo.::>>config_user\!userg!.settings
	@echo.::To avoid errors in Log OS, please don't edit this file>>config_user\!userg!.settings
	@echo.::>>config_user\!userg!.settings
	@echo.::Saved at : %date% %time%>>config_user\!userg!.settings
	@echo.userg=!userg!,>>config_user\!userg!.settings
	@echo.usercolor=!usercolor!,>>config_user\!userg!.settings
	@echo.pp=%pp%,>>config_user\!userg!.settings
	@echo.userdescription=!userdescription!,>>config_user\!userg!.settings
	@echo.type=User,>>config_user\!userg!.settings
)
)
set "type="
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
echo ::WARNING!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
::
if "%sos%"=="true" title Saving username

if "%sos%"=="true" title Saving user number
if "%sos%"=="true" title Saving incorrect message
@echo ip=%ip%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving safe mode color
@echo rndcolor=%rndcolor%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving administrator's password
@echo adminpass=%adminpass%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving plugins



if "%sos%"=="true" title Saving user description

if "%sos%"=="true" title Saving hibernate state
@echo hibernated=false,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving hibernaet restore variable
@echo restore=%restore%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Setting time
set t=
if "%sos%"=="true" title Saving user color

if "%sos%"=="true" title Saving admin color
@echo admincol=%admincol%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving guest color
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving factory settings
@echo factory=no,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving guest settigns
@echo noguest=%noguest%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving logon color
@echo logoncolor=%logoncolor%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving autoreset setting
@echo autoreset=%autoreset%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving admin's number
if "%sos%"=="true" title Saving admin's name
@echo adname=%adname%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving administrator settings
@echo adno=%adno%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving guest number
if "%sos%"=="true" title Saving administrator's description
@echo admindescript=%admindescript%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving classic logon setting
@echo classic=%classic%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving autologon setting
@echo autologon=%autologon%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving autologon name variable
@echo loginname=%loginname%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving nopass settings
@echo nopass=%nopass%,>>config_os\%OSname%.settings
@echo noupass=%noupass%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving compatibility
@echo compatibility=%compatibility%,>>config_os\%OSname%.settings
::@echo resolution=%resolution%,>>config_os\%OSname%.settings
@echo constart=%constart%,>>config_os\%OSname%.settings
@echo sounded=%sounded%,>>config_os\%OSname%.settings
@echo oldstart=%oldstart%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Deleting desktop log
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if "%sos%"=="true" title Saving settings log
if not "%domain%"=="" @echo.domain=%domain%,>>config_os\%OSname%.settings
if "%domain%" NEQ "logos_settings" call :checkansavedomain
goto :eof

:disablesos
if "%sos%"=="true" title Disabling SOS mode
set sos=false
goto help

:enablesos
set sos=true
if "%sos%"=="true" title Showing help
goto help

:setfscreen
if "%sos%"=="true" title Checking if fullscreen is enabled
if "%fullscreen%"=="true" goto disablesf
if "%sos%"=="true" title Enabling fullscreen
goto enablesf

:disablesf
if "%sos%"=="true" title Disabling fullscreen
set fullscreen=false
if "%sos%"=="true" title Setting registry value
reg add HKCU\Console\ /v Fullscreen /t REG_DWORD /d 0 /f >nul
if "%sos%"=="true" title Clearing screen
cls
if "%sos%"=="true" title Deleting settings
if "%live%"=="yes" goto dsbsavenow
if "%sos%"=="true" title Saving settings
set hibernated=true
set now=true
if "%user%"=="%userg%" goto notadminsf
if "%user%"=="Guest" goto notadminorusersf
goto adminyessf
:notadminsf
goto adminyessf
:notadminorusersf
:adminyessf
if "%sos%"=="true" title Saving successfull shutdown log
@echo Shutdown was successfull>>log_os\Shutdown
:dsbsavenow
if "%sos%"=="true" title Starting LogOS...
start "" %0
if "%sos%"=="true" title Exit
if exist log_os\lgr del log_os\lgr
exit
if "%sos%"=="true" title Shutdown failed, returning settings
goto s

:enablesf
:enablesf2
if "%sos%"=="true" title Enabling fullscreen
set fullscreen=true
if "%sos%"=="true" title Writing registry value
if not exist "C:\Windows\System32\bcdboot.exe" reg add HKCU\Console\ /v Fullscreen /t REG_DWORD /d 1 /f >nul
if "%sos%"=="true" title Clearing screen
cls
if "%sos%"=="true" title Deleting %OSname% settings
if "%live%"=="yes" goto nosavenable
if "%sos%"=="true" title Saving settings
set hibernated=true
set now=true
if "%user%"=="%userg%" goto notadminsf2
if "%user%"=="Guest" goto notadminorusersf2
goto adminyessf2
:notadminsf2
goto adminyessf
:notadminorusersf2
:adminyessf2
if "%sos%"=="true" title Saving shutdown log
@echo Shutdown was successfull>>log_os\Shutdown
:nosavenable
if "%sos%"=="true" title Starting LogOS
if "%sos%"=="true" title Exit
call :wcall
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if exist log_os\lgr del log_os\lgr
start /b "" %0
exit
goto s 

:ars
if "%sos%"=="true" title Checking if autoreset is enabled
if %autoreset% EQU true goto arst
goto arsf
:arst
if "%sos%"=="true" title Disabling autoreset
set autoreset=false
goto s
:arsf
if "%sos%"=="true" title Enabling autoreset...
set autoreset=true
if "%sos%"=="true" title Returning settings
goto s
:usersettings
if "%sos%"=="true" title Checking if you are a guest
if "%gunlimited%"=="yes" goto usersettingskip
if "%user%"=="Guest" goto guest202
:usersettingskip
if "%sos%"=="true" title Clearing screen
cls
if "%sos%"=="true" title Output
Echo.            User settings
Echo.
if not "%user%"=="" (
Echo. 1.Delete user account
Echo. %user%
) else (
Echo. 1.Delete user account
Echo. * CANNOT DELETE STATIC ACCOUNTS *
)
Echo.
Echo. 2.Create new user account
Echo. Allows you to add more user accounts
Echo.
Echo. 3.Back to settings
Echo. Goes back
Echo.
if not "%user%"=="" (
Echo. 4.Your name
Echo. %user%
) else (
Echo. 4.Your name
)
Echo.
Echo. 5.Your password
Echo. %pass%
Echo.
Echo. 6.Description
Echo. %description%
Echo.
Echo. 7. Autologon
Echo. %autologon%
if "%sos%"=="true" title Checking if autologon is enabled
if "%autologon%"=="enabled" Echo. for %loginname%
if "%sos%"=="true" title Output
Echo.
Echo. 8. Next page
Echo. Show more settings
Echo.
if "%user%"=="%adname%" Echo. 9.Disable Guest
if "%user%"=="%adname%" Echo. %noguest%
if "%user%"=="%adname%" Echo.   Disable administrator
if "%user%"=="%adname%" Echo. %adno%
if "%sos%"=="true" title Waiting for user input...
if exist bin_os\bg.exe bg cursor 1
set/panswer= Your selection:
if exist bin_os\bg.exe bg cursor 0
cls
if "%sos%"=="true" title Searching for %answer%
if not "%user%"=="%adname%" goto skipsetup2ad
if "%answer%"=="9" goto dien
if "%answer%"=="9a" goto diengu
if "%answer%"=="9b" goto dienad
:skipsetup2ad
if not "%user%"=="" (
if "%answer%"=="1" goto deluserg
if "%answer%"=="2" goto newaccount
) else (
if "%answer%"=="2" (
cls
echo.
echo. Cannot this setting
echo.
echo. Details: Static account cannot be used
echo.
pause
)
)
if "%answer%"=="3" goto s
if not "%user%"=="" (
if "%answer%"=="4" goto name
) else (
if "%answer%"=="4" (
echo.
echo Current name: %user%
echo.
echo.
echo Note: This account is static
echo.
echo In order to change one's name, an account
echo has to dynamic. Please log out and log in
echo as a dynamic user account.
echo.
pause
)
)
if "%answer%"=="5" goto password
if "%answer%"=="6" goto descript
if "%answer%"=="7" goto alog
if "%answer%"=="8" goto logsetup
if "%answer%"=="7" goto locolor
if "%answer%"=="8" goto user2settings
if "%sos%"=="true" title Output
Echo Invalid command
if "%sos%"=="true" title Returning user settings
goto usersettings

:user2settings
goto logsetup

:adgjiadgjiopasfjiopasfjopasf
if "%answer%"=="1" goto rmapass
goto skgkkkp

:rmpass2
Echo.
Echo. 1. Remove administrator's password
Echo. %nopass%
Echo.
goto :eof

:rmvpass
if "%noupass%"=="true" set noupass=false&set "pp="&call :savesetup&goto passnormal2&goto user2settings
if "%noupass%"=="false" set noupass=true&set "pp="&call :savesetup&goto user2settings
goto user2settings

:rmapass
if "%nopass%"=="yes" set nopass=no&goto user2settings
if "%nopass%"=="no" set nopass=yes&goto user2settings
goto user2settings

:alog
if "%sos%"=="true" title Checking if autologon is enabled
if "%autologon%"=="enabled" goto desablealog
goto enablealog

:desablealog
if "%sos%"=="true" title Disabling autologon
set autologon=disabled
set loginname=
if "%sos%"=="true" title Returning user settings
goto usersettings

:enablealog
if "%sos%"=="true" title Enabling autologon
set autologon=enabled
if "%sos%"=="true" title Setting loginname as %user%
set loginname=%user%
if "%sos%"=="true" title Returning user settings
goto usersettings

:logsetup
cls
Echo.            User settings
if "%user%"=="%adname%" call :rmpass2
if "%user%"=="%adname%" goto skgkp150
if "%user%"=="" echo.&echo. 1. (does nothing)&echo.&goto skgkp150
Echo.
Echo. 1.Remove user password
if not "%pp%"=="" Echo. false
if "%pp%"=="" Echo. true
Echo.
:skgkp150
Echo.
Echo. 2.log_os\Logonscreen color
Echo. Changes logon color
Echo. Color %logoncolor%
Echo.
Echo. 3.Use classic logon
Echo. %classic%
Echo.
Echo. 4.Go back
Echo. Goes back
Echo.
if exist bin_os\bg.exe bg cursor 1
set/panswer=Your selection:
if exist bin_os\bg.exe bg cursor 0
cls
if "%user%"=="" goto skgkkkp
if "%user%"=="%adname%" goto adgjiadgjiopasfjiopasfjopasf
if "%answer%"=="1" goto rmvpass
:skgkkkp
if "%answer%"=="2" goto locolor
if "%answer%"=="3" goto cclassic00
if "%answer%"=="4" goto usersettings
Echo Invalid command
goto logsetup

:cclassic00
cls
if %classic% EQU true goto cclassic01
if %classic% EQU false goto cclassic02

:cclassic01
set classic=false
goto logsetup

:cclassic02
set classic=true
goto logsetup


:dien
if "%user%"=="Guest" goto guest202
cls
Echo.            User settings
Echo.
Echo. 1.Disable Guest
Echo. %noguest%
Echo.
Echo. 2.Disable administrator
Echo. %adno%
Echo.
Echo. 3.Back to user settings
Echo. Goes back
Echo.
if exist bin_os\bg.exe bg cursor 1
set/panswer= Your selection:
if exist bin_os\bg.exe bg cursor 0
cls
if "%answer%"=="1" goto diengu
if "%answer%"=="2" goto dienad
if "%answer%"=="3" goto usersettings

Echo Invalid command
goto usersettings

:locolor
cls
Echo.
Echo. Type ^^/? for help
set /p logoncolor=Enter color:
goto logsetup

:deluserg
cls
Echo.
echo User account deletion
echo.
echo This will delete selected user account. Your home
echo directory will be erased (/specific_user/%user%)
echo.
Echo If you continue please make sure that you
Echo have a backup.
Echo.
Pause
cls
echo.
echo Deletion process
echo.
echo * Do not close %OSname% during this process *
echo.
ping localhost -n 2 >nul
Echo Deleting user account
if "%live%"=="yes" goto start
echo  - Deleting home directory
rd specific_user\%user% /s /q 
echo  - Deleting user configuration
del config_user\%user%.settings
if "%user%"=="%userg%" set "userg="
if "%user%"=="%adname%" set "adname="
echo  - Saving settings...
set "tempfs=%user%"
call :savesetup
echo  - Deleting logs
if exist log_os\log.txt del log_os\log.txt
echo  - Reloading settings
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
echo  - Settings tempfs variable
set "tempfs=%user%"
echo.
:yest
if "%ERRORLEVEL%"=="0" (
	cls
	echo.
	echo Good bye, %user%^^!
	echo.
	echo Your user data and configuration have been
	echo successfully deleted.
	echo.
	echo You may continue using %OSname% for some tasks,
	echo but keep in mind that your home folder is no longer
	echo accessible.
	echo.
	echo After you log out you'll no longer be able to log
	echo back in or access your data that wasn't backed up
	echo in any way.
	echo.
) else (
echo Some errors may have occured during the deletion process...
pause
)
pause
goto usersettings

:guest202
cls
Echo.
Echo CRITICAL ERROR
Echo.
Echo Your access to other user
Echo accounts is disabled by
Echo your administrator.
Echo.
Pause
goto s

:dienad
if "%user%" EQU "Guest" goto error29193
if "%adno%" EQU "true" goto enad
if "%adno%" EQU "false" goto diad

:diad
set an=
set adno=true
set adname=
if "%adno%"=="true" goto checkmorenumbers12
if "%noguest%"=="true" set n=2&goto cba3210112
set n=3
goto cba3210112
:checkmorenumbers12
if "%noguest%"=="true" set n=1&goto cba3210112
set n=2
goto cba3210112
:cba3210112
if "%noguest%" EQU "true" goto sn2
if "%noguest%" EQU "false" goto sn1
if "%answer%" == "settings user disable administrator -false" goto start
if "%answer%" == "Settings user disable administrator -false" goto start
if "%answer%" == "SETTINGS USER DISABLE ADMINISTRATOR -FALSE" goto start
if "%restart%"=="true" set restart=&goto start
goto newaccount

:sn2
set gn=2
set n=2
goto usersettings

:sn1
set gn=1
set n=2
goto usersettings

:enad
set an=1
set adno=false
set adname=Administrator
set gn=2
if "%adno%"=="true" goto checkmorenumbers122
if "%noguest%"=="true" set n=2&goto cba32101122
set n=3
goto cba32101122
:checkmorenumbers122
if "%noguest%"=="true" set n=1&goto cba32101122
set n=2
goto cba32101
:cba32101122
if "%answer%" == "settings user disable administrator -true" goto start
if "%answer%" == "Settings user disable administrator -true" goto start
if "%answer%" == "SETTINGS USER DISABLE ADMINISTRATOR -TRUE" goto start
if "%restart%"=="true" set restart=&goto start
goto usersettings

:diengu
if "%user%" == "Guest" goto error29193
if %noguest% EQU true goto digu
if %noguest% EQU false goto engu

:digu
set n=3
set noguest=false
if "%answer%" == "settings user disable guest -false" goto start
if "%answer%" == "Settings user disable guest -false" goto start
if "%answer%" == "SETTINGS USER DISABLE GUEST -FALSE" goto start
if "%restart%"=="true" set restart=&goto start
if "%adno%"=="true" goto checkmorenumbers1
set n=3
goto cba321011
:checkmorenumbers1
set n=2
goto cba321011
:cba321011
goto usersettings

:engu
set n=2
set noguest=true
if "%adno%"=="true" goto checkmorenumbers11
goto cba3210111
:checkmorenumbers11
set n=2
goto cba3210111
:cba3210111
if "%answer%" == "settings user disable guest -true" goto start
if "%answer%" == "Settings user disable guest -true" goto start
if "%answer%" == "SETTINGS USER DISABLE GUEST -TRUE" goto start
if "%restart%"=="true" set restart=&goto start
goto usersettings

:error29193
cls
Echo.
Echo Error
Echo.
Echo Guest don't have access to
Echo disable or enable itself.
Echo.
Pause>nul
goto s

:name
if "%user%" EQU "%adname%" goto error44251
if "%user%" EQU "Guest" goto error442
:namenormal
if "%loginname%"=="%userg%" set redflag=true
cls
if exist bin_os\bg.exe bg cursor 1
set/puser=Enter name:
if exist bin_os\bg.exe bg cursor 0
cls
cls
cls
set userg=%user%
if "%redflag%"=="true" set loginname=%userg%&set "redflag="
:s
goto setup

:password
if "%user%" EQU "%adname%" goto adminpass
if "%user%" EQU "Guest" goto error442
if "%user%" EQU "%userg%" goto passwordnormal
goto password
:passwordnormal
if "%noupass%"=="true" goto passnormal2
cls
if exist bin_os\bg.exe bg cursor 1
set/pctpass=Enter current password to confirm:
cls
if "%ctpass%"=="%pp%" goto passnormal2
goto error39201
:passnormal2
if "%noupass%"=="true" set noupass=false
if "%pass%"=="You have no password" set pass=You have password
set /p pp=Enter your new password:
if exist bin_os\bg.exe bg cursor 0
call :savesetup
goto s

:error39201
cls
Echo.
Echo Password you entered was incorrect.
Echo.
Pause
goto s

:error44251
if "%loginname%"=="%adname%" set redflag=true
cls
if exist bin_os\bg.exe bg cursor 1
set/padname=Enter your new name:
if exist bin_os\bg.exe bg cursor 0
set user=%adname%
if "%redflag%"=="true" set loginname=%adname%&set "redflag="
if "%restart%"=="true" set restart=&goto start
goto usersettings

:error442
cls
Echo.
Echo Error
Echo.
Echo Guests can't change or create their
Echo password/name
Echo.
Pause>nul
goto s

:adminpass
cls
if exist bin_os\bg.exe bg cursor 1
if "%nopass%"=="yes" goto adminpass22
set/pctpass=Enter your current password to confirm:
cls
if "%ctpass%"=="%adminpass%" goto adminpass22
goto error28934
:adminpass22
if "%nopass%"=="yes" set nopass=no
if "%pass%"=="You have no password" set pass=You have password
set/padmipass=Enter your new password:
if exist bin_os\bg.exe bg cursor 0
set adminpass=%admipass%
call :savesetup
goto s

:error28934
cls
Echo.
Echo Password you entered was incorrect
Echo.
Pause
goto s

:recolor
set "prevcol=%rndcolor%"
:loccolor
call :humanread
if exist bin_os\bg.exe bg cursor 1
set "q="
if "%rndcolor:~0,1%"=="%rndcolor:~1%" goto changef
cls
echo.
echo Color settings (current: %rndcolor%)
echo.
bg print %prevcol% "1. Background: "&bg print %rndcolor:~1%%rndcolor:~0,1% "%back%\n"
bg print %prevcol% "2. Foreground: "&bg print %rndcolor:~0,1%%rndcolor:~1% "%fore%\n"
echo 3. Go back
echo.
set /p answer=Please enter a number:
if "%answer%"=="1" goto changeb
if "%answer%"=="2" goto changef
if "%answer%"=="3" color %rndcolor%&goto setup
goto loccolor

:humanread
if "%rndcolor:~0,1%"=="0" set "back=black"
if "%rndcolor:~0,1%"=="1" set "back=blue"
if "%rndcolor:~0,1%"=="2" set "back=green"
if "%rndcolor:~0,1%"=="3" set "back=aqua"
if "%rndcolor:~0,1%"=="4" set "back=red"
if "%rndcolor:~0,1%"=="5" set "back=purple"
if "%rndcolor:~0,1%"=="6" set "back=yellow"
if "%rndcolor:~0,1%"=="7" set "back=white"
if "%rndcolor:~0,1%"=="8" set "back=gray"
if "%rndcolor:~0,1%"=="9" set "back=light blue"
if "%rndcolor:~0,1%"=="a" set "back=light green"
if "%rndcolor:~0,1%"=="b" set "back=cyan"
if "%rndcolor:~0,1%"=="c" set "back=light red"
if "%rndcolor:~0,1%"=="d" set "back=pink"
if "%rndcolor:~0,1%"=="e" set "back=yellow"
if "%rndcolor:~0,1%"=="f" set "back=bright white"
if "%rndcolor:~1%"=="0" set "fore=black"
if "%rndcolor:~1%"=="1" set "fore=blue"
if "%rndcolor:~1%"=="2" set "fore=green"
if "%rndcolor:~1%"=="3" set "fore=aqua"
if "%rndcolor:~1%"=="4" set "fore=red"
if "%rndcolor:~1%"=="5" set "fore=purple"
if "%rndcolor:~1%"=="6" set "fore=yellow"
if "%rndcolor:~1%"=="7" set "fore=white"
if "%rndcolor:~1%"=="8" set "fore=gray"
if "%rndcolor:~1%"=="9" set "fore=light blue"
if "%rndcolor:~1%"=="a" set "fore=light green"
if "%rndcolor:~1%"=="b" set "fore=cyan"
if "%rndcolor:~1%"=="c" set "fore=light red"
if "%rndcolor:~1%"=="d" set "fore=pink"
if "%rndcolor:~1%"=="e" set "fore=yellow"
if "%rndcolor:~1%"=="f" set "fore=bright white"
goto :eof

:changeb
if "%rndcolor:~0,1%"=="0" set "rndcolor=1%rndcolor:~1%"&goto loccolor
if "%rndcolor:~0,1%"=="1" set "rndcolor=2%rndcolor:~1%"&goto loccolor
if "%rndcolor:~0,1%"=="2" set "rndcolor=3%rndcolor:~1%"&goto loccolor
if "%rndcolor:~0,1%"=="3" set "rndcolor=4%rndcolor:~1%"&goto loccolor
if "%rndcolor:~0,1%"=="4" set "rndcolor=5%rndcolor:~1%"&goto loccolor
if "%rndcolor:~0,1%"=="5" set "rndcolor=6%rndcolor:~1%"&goto loccolor
if "%rndcolor:~0,1%"=="6" set "rndcolor=7%rndcolor:~1%"&goto loccolor
if "%rndcolor:~0,1%"=="7" set "rndcolor=8%rndcolor:~1%"&goto loccolor
if "%rndcolor:~0,1%"=="8" set "rndcolor=9%rndcolor:~1%"&goto loccolor
if "%rndcolor:~0,1%"=="9" set "rndcolor=a%rndcolor:~1%"&goto loccolor
if "%rndcolor:~0,1%"=="a" set "rndcolor=b%rndcolor:~1%"&goto loccolor
if "%rndcolor:~0,1%"=="b" set "rndcolor=c%rndcolor:~1%"&goto loccolor
if "%rndcolor:~0,1%"=="c" set "rndcolor=d%rndcolor:~1%"&goto loccolor
if "%rndcolor:~0,1%"=="d" set "rndcolor=e%rndcolor:~1%"&goto loccolor
if "%rndcolor:~0,1%"=="e" set "rndcolor=f%rndcolor:~1%"&goto loccolor
if "%rndcolor:~0,1%"=="f" set "rndcolor=0%rndcolor:~1%"&goto loccolor
set "rndcolor=0%rndcolor:~1%"
goto loccolor

:changef
if "%rndcolor:~1%"=="0" set "rndcolor=%rndcolor:~0,1%1"&goto loccolor
if "%rndcolor:~1%"=="1" set "rndcolor=%rndcolor:~0,1%2"&goto loccolor
if "%rndcolor:~1%"=="2" set "rndcolor=%rndcolor:~0,1%3"&goto loccolor
if "%rndcolor:~1%"=="3" set "rndcolor=%rndcolor:~0,1%4"&goto loccolor
if "%rndcolor:~1%"=="4" set "rndcolor=%rndcolor:~0,1%5"&goto loccolor
if "%rndcolor:~1%"=="5" set "rndcolor=%rndcolor:~0,1%6"&goto loccolor
if "%rndcolor:~1%"=="6" set "rndcolor=%rndcolor:~0,1%7"&goto loccolor
if "%rndcolor:~1%"=="7" set "rndcolor=%rndcolor:~0,1%8"&goto loccolor
if "%rndcolor:~1%"=="8" set "rndcolor=%rndcolor:~0,1%9"&goto loccolor
if "%rndcolor:~1%"=="9" set "rndcolor=%rndcolor:~0,1%a"&goto loccolor
if "%rndcolor:~1%"=="a" set "rndcolor=%rndcolor:~0,1%b"&goto loccolor
if "%rndcolor:~1%"=="b" set "rndcolor=%rndcolor:~0,1%c"&goto loccolor
if "%rndcolor:~1%"=="c" set "rndcolor=%rndcolor:~0,1%d"&goto loccolor
if "%rndcolor:~1%"=="d" set "rndcolor=%rndcolor:~0,1%e"&goto loccolor
if "%rndcolor:~1%"=="e" set "rndcolor=%rndcolor:~0,1%f"&goto loccolor
if "%rndcolor:~1%"=="f" set "rndcolor=%rndcolor:~0,1%0"&goto loccolor
set "rndcolor=%rndcolor:~0,1%7"
goto loccolor


SET rndcolor=%rndcolor:~0,2%
if "%rndcolor%"=="91" echo Warning: This color might be hard to read&set /p q=Are you sure you want to continue? (y/n)
if "%rndcolor%"=="19" echo Warning: This color might be hard to read&set /p q=Are you sure you want to continue? (y/n)
if "%rndcolor%"=="2A" echo Warning: This color might be hard to read&set /p q=Are you sure you want to continue? (y/n)
if "%rndcolor%"=="A2" echo Warning: This color might be hard to read&set /p q=Are you sure you want to continue? (y/n)
if "%rndcolor%"=="B3" echo Warning: This color might be hard to read&set /p q=Are you sure you want to continue? (y/n)
if "%rndcolor%"=="3B" echo Warning: This color might be hard to read&set /p q=Are you sure you want to continue? (y/n)
if "%rndcolor%"=="C4" echo Warning: This color might be hard to read&set /p q=Are you sure you want to continue? (y/n)
if "%rndcolor%"=="4C" echo Warning: This color might be hard to read&set /p q=Are you sure you want to continue? (y/n)
if "%rndcolor%"=="D5" echo Warning: This color might be hard to read&set /p q=Are you sure you want to continue? (y/n)
if "%rndcolor%"=="5D" echo Warning: This color might be hard to read&set /p q=Are you sure you want to continue? (y/n)
if "%rndcolor%"=="E6" echo Warning: This color might be hard to read&set /p q=Are you sure you want to continue? (y/n)
if "%rndcolor%"=="6E" echo Warning: This color might be hard to read&set /p q=Are you sure you want to continue? (y/n)
if "%rndcolor%"=="7F" echo Warning: This color might be hard to read&set /p q=Are you sure you want to continue? (y/n)
if "%rndcolor%"=="F7" echo Warning: This color might be hard to read&set /p q=Are you sure you want to continue? (y/n)
if "%q%"=="y" set "q="&goto coloring
if "%q%"=="Y" set "q="&goto coloring
if "%q%"=="n" set "q="&goto recolor
if "%q%"=="N" set "q="&goto recolor
goto coloring

:precoloring
set rndcolor=%bgcolor%%fgcolor%
goto coloring

:colorerror
cls
Echo The following color code is not valid: %rndcolor%
Echo Please try again
pause
goto recolor

:coloring
Echo. Coloring...
Color %rndcolor%
if %ERRORLEVEL% GEQ 1 goto colorerror
if "%user%" EQU "Guest" set guestcolor=%rndcolor%
if "%user%" EQU "%adname%" set admincol=%rndcolor%
if "%user%" EQU "%userg%" set usercolor=%rndcolor%
if "%user%" EQU "%domainusername%" set domaincolor=%rndcolor%
goto s

:descript
if "%description%" == "%guestdescript%" goto guest2432
if "%description%" == "%admindescript%" goto admindescription
if "%description%" == "%userdescription%" goto normaldescript
if "%description%" == "%domaindescription%" goto domaindescript
goto notrespond

:notrespond
cls
Echo Settings are not responding
Echo.
Pause
goto start

:domaindescript
cls
Echo.
Echo.
Echo.
Echo. Current : %description%
Echo.
Echo.
if exist bin_os\bg.exe bg cursor 1
set/pdomaindescription=
if exist bin_os\bg.exe bg cursor 0
cls
cls
cls
set description=%domaindescription%
goto s

:normaldescript
cls
Echo.
Echo.
Echo.
Echo. Current : %description%
Echo.
Echo.
if exist bin_os\bg.exe bg cursor 1
set/puserdescription=
if exist bin_os\bg.exe bg cursor 0
cls
cls
cls
set description=%userdescription%
goto s

:guest2432
cls
Echo.
Echo.
Echo.
Echo. Current : %description%
Echo.
Echo.
if exist bin_os\bg.exe bg cursor 1
set/pguestdescript=
if exist bin_os\bg.exe bg cursor 0
cls
cls
cls
set description=%guestdescript%
goto s

:admindescription
cls
Echo.
Echo.
Echo.
Echo. Current : %description%
Echo.
Echo.
if exist bin_os\bg.exe bg cursor 1
set /p admindescript=
if exist bin_os\bg.exe bg cursor 0
cls
cls
cls

:saving642
set description=%admindescript%
goto s

:about
call :passit
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
cls
Echo.              About
Echo.
Echo.   Name         : LogOS %version%
Echo.   Created by   : MarkusMaal
Echo.   Licenced to  : %username%
Echo.   Created with : Notepad
Echo.   What's new   : New start screen
Echo.                  interface
Echo.
Echo.
Echo Changelog:
Echo 2.9
Echo Added new boot animation
Echo Added new login screen
Echo Troubleshooter, when pressing F12 at the login screen
Echo New commands and command system
Echo Console mode for system administrators
Echo Integrated bootloader (you can still use external if neccessary)
Echo Reload cache option in recovery mode
Echo Fixed error when renaming autologin enabled user
Echo Restricted access to the commands for a standard user
Echo New system upgrade screen
if "%screen_h%" == "25" pause>nul
Echo Custom set up when pressing S on a factory reset
Echo Screen saver
Echo Removed OTA update from recovery mode (because servers are down)
Echo True hibernation (keeps every single variable from the last session)
Echo Fixed custom boot screen bug
Echo.
Echo 2.86
Echo Added new start screen interface
Echo Updated settings app
Echo New save system, that you can't notice
if "%screen_h%"=="35" pause>nul
Echo in faster systems
Echo OTA update in recovery mode
Echo Native widescreen support
Echo Removed screen resolutions
if "%screen_h%"=="45" Pause>nul
Echo 2.85
Echo Removed CHOICE.EXE, BG.EXE replaces it
Echo Startup is now much faster
Echo No freezing at startup
Echo Updated clock to be more accurate
Echo Updated Recovery mode
Echo Enter recovery mode while the boot screen
Echo shows up.
Echo Full changelog page at about
Echo.
Pause>nul
goto start

:fe
bg cursor 1
if not "%fullscreen%"=="true" mode %screen_w%,%screen_h%
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
cls
Echo.
Echo Hotkeys:
Echo.
Echo M - Make directory   C - Change directory
Echo O - Open file        B - Go a directory up
Echo D - Show directories E - Return to start
Echo X - Delete a file    R - Rename a file
Echo Y - Copy a file      T - Move a file
dir /w /a-d /p
if not "%compat%"=="yes" choice /C:modcbexryt /n
if %errorlevel%==1 goto created
if %errorlevel%==2 goto ofile
if %errorlevel%==3 goto dshow
if %errorlevel%==4 goto cdnow
if %errorlevel%==5 goto backupnow1123
if %errorlevel%==6 goto start
if %errorlevel%==7 goto dlnow
if %errorlevel%==8 goto rnnow
if %errorlevel%==9 goto copyf
if %errorlevel%==10 goto tmove

:copyf
set /p fname=Enter file name:
if not exist "%fname%" goto fe
set /p codir=Enter directory where to copy file:
copy "%fname%" "%codir%"
if exist "%codir%\%fname%" echo File successfully copied
if not exist "%codir%\%fname%" echo File wasn't copied due errors
Pause>nul
goto fe

:tmove
set /p fname=Enter file name:
if not exist "%fname%" goto fe
set /p modir=Enter directory where to move file:
move "%fname%" "%codir%"
if exist "%modir%\%fname%" echo File successfully moved
if not exist "%modir%\%fname%" echo File wasn't moved due errors
Pause>nul
goto fe

:dlnow
set /p delname=Enter file name:
if exist %delname% del %delname%
if not exist "%delname%" echo File successfully deleted&pause>nul
if exist %delname% Echo File deleting was unsuccessful&pause>nul
goto fe

:rnnow
set /p oldname=Enter old file name:
set /p newname=Enter new file name:
ren %oldname% %newname%
if exist "%oldname%" echo File rename was unsuccessful
if not exist "%oldname%" echo File was successfully renamed
Pause>nul
goto fe

:created
set /p dirm=Enter new directory name:
md %dirm%
if exist "%dirm%" echo Directory successfully created
if not exist "%dirm%" echo Directory wasn't created due errors
Pause>nul
goto fe

:ofile
set /p fopen=Enter file name:
cls
Echo.
Echo Open
Echo.
Echo 1. As Application
Echo 2. Edit as a text document
Echo 3. View as a text document
Echo 4. Load file as command script
Echo.
set /p csdd=Your selection:
if "%csdd%"=="1" cmd /k %fopen%&color %rndcolor%&goto fe
if "%csdd%"=="2" set editable=%fopen%&set retofile=true&goto readytoedit
if "%csdd%"=="3" set directory=%cd%&set retofile=true&set text=%fopen%&goto typenow
if "%csdd%"=="4" call %fopen%&color %rndcolor%&goto fe
goto ofile

:dshow
cls
Echo.
Echo M - Make directory   C - Change directory
Echo O - Open file        B - Go a directory up
Echo D - Hide directories E - Return to start
Echo X - Delete a file    R - Rename a file
Echo Y - Copy a file      T - Move a file
dir /w /p
if not "%compat%"=="yes" choice /C:modcbexryt /n
if %errorlevel%==1 goto created
if %errorlevel%==2 goto ofile
if %errorlevel%==3 goto fe
if %errorlevel%==4 goto cdnow
if %errorlevel%==5 goto backupnow1123
if %errorlevel%==6 goto return
if %errorlevel%==7 goto dlnow
if %errorlevel%==8 goto rnnow
if %errorlevel%==9 goto copyf
if %errorlevel%==10 goto tmove
:return
cd "%ld%"
goto start

:cdnow
set /p dgggggfolder=Enter folder name:
cd %dgggggfolder%
goto fe

:backupnow1123
cd..
goto fe

:wouldnewacc
if "%autologon%"=="enabled" goto autologonnow
goto newaccount

:checknewaccount_216
goto changeaccount
if "%user%"=="%adname%" cls&echo Please log in with you account&echo to change its name and password.&pause&goto usersettings
if "%user%"=="Guest" cls&echo Please log in with you account&echo to change its name and password.&pause&goto usersettings
if "%user%"=="" cls&echo Warning: Access is denied&pause&goto usersettings
:newaccount
cls
Echo.
if "%old%"=="false" Echo What type of user account would you like to add?
if "%old%"=="true" Echo What type of user account would you like to add/change?
if "%old%"=="" Echo What type of user account would you like to add/change?
Echo.
Echo 1. Regular user
Echo Has access to most of the features, can't disable user accounts nor add them, but can still access
Echo system related features (e.g. eCMD)
Echo.
if "%old%"=="false" Echo 2. System administrator
if "%old%"=="false" Echo User type with the most priviledges. He can perform system related tasks and change user accounts
if "%old%"=="false" Echo.
if "%old%"=="false" Echo 3. Guest
if "%old%"=="false" Echo User with limited access to certain features. This user type can still access most of the apps (with
if "%old%"=="false" Echo the exception of eCMD)
if "%old%"=="false" Echo.
if "%old%"=="true" Echo 2. New mode
if "%old%"=="" Echo 2. New mode
if "%old%"=="false" Echo 4. Old mode
if "%old%"=="false" Echo This allows you to use old user account method which can provide compatiblity with older versions of Log OS.
if "%old%"=="false" Echo Keep in mind that if you enable it, next time you reboot, all accounts created with new method will be erased.
if "%old%"=="true" Echo This allows you to use much more accounts with different types in Log OS. It may have compatiblity issues when
if "%old%"=="true" Echo backing up in newer version and restoring in older one
if "%old%"=="" Echo This allows you to use much more accounts with different types in Log OS. It may have compatiblity issues when
if "%old%"=="" Echo backing up in newer version and restoring in older one
Echo In old mode, you can have up to 3 accounts, new mode allows you to make up to 2147483646 accounts.
set /p select=Your selection:
if "%select%"=="1" goto changeaccount
if "%old%"=="true" goto choldselect
if "%old%"=="" goto choldselect
if "%select%"=="2" goto newadminaccountadd
if "%select%"=="3" goto newguestaccountadd
if "%select%"=="4" goto checkold
goto newaccount
:choldselect
if "%select%"=="2" goto checkold
goto newaccount
:checkold
if "%old%"=="false" set old=true&goto newaccount
if "%old%"=="" set old=false&goto newaccount
if "%old%"=="true" set old=false&goto newaccount

:newguestaccountadd
set /a gcs=%gcs%+1
cls
Echo.
Echo Welcome to new guest setup
Echo.
Echo If you'd like to add a name, type them in. If you leave it blank, 
Echo the guest will have a name Guest.
Echo.
set /p gname%gcs%=Enter name:
if "!gname%gcs%!"=="" set gname%gcs%=Guest
cls
Echo.
Echo Verification
Echo.
Echo Please verify that the following information is correct:
Echo.
Echo Name: !gname%gcs%!
Echo.
Echo Please try again, when the info is not correct
Echo.
Pause >nul
md specific_user\!gname%gcs%!
md specific_user\!gname%gcs%!\picture
md specific_user\!gname%gcs%!\document
md specific_user\!gname%gcs%!\audio
md specific_user\!gname%gcs%!\video
@echo.::WARNING>>config_user\!gname%gcs%!.settings
@echo.::>>config_user\!gname%gcs%!.settings
@echo.::To avoid errors in Log OS, please don't edit this file>>config_user\!gname%gcs%!.settings
@echo.::>>config_user\!gname%gcs%!.settings
@echo.::Saved at : %date% %time%>>config_user\!gname%gcs%!.settings
@echo.gname=!gname%gcs%!,>>config_user\!gname%gcs%!.settings
@echo.guestcolor=07,>>config_user\!gname%gcs%!.settings
@echo.type=Guest,>>config_user\!gname%gcs%!.settings
:gsuccess
cls
Echo.
Echo Account creation successful
Echo.
set /p answer=Add more accounts? (Y/N)
if "%answer%"=="Y" goto newaccount
if "%answer%"=="y" goto newaccount
if "%answer%"=="N" goto logon
if "%answer%"=="n" goto logon
goto gsuccess




:newadminaccountadd
set /a acs=%acs%+1
cls
Echo.
Echo Welcome to new administrator setup
Echo.
Echo If you'd like to add a name and password, type them in. If you leave them
Echo blank, the admin will have your computer's username and it will have no
Echo password (passwords are recommended tough).
Echo.
set /p adname%acs%=Enter name:
if "!adname%acs%!"=="" set adname%acs%=%username%
set /p adminpass%acs%=Enter password:
if "!adminpass%acs%!"=="" set nopass%acs%=yes
cls
Echo.
Echo Enter in a description (optional)
Echo.
Echo Description will be shown in the start screen. Make it
Echo describe the account.
Echo.
set /p admindescript%acs%=Enter the description:
cls
Echo.
Echo Verification
Echo.
Echo Please verify that the following information is correct:
Echo.
Echo Name: !adname%acs%!
Echo Password: !adminpass%acs%!
Echo Description: !admindescript%acs%!
Echo.
Echo Please try again, when the info is not correct
Echo.
Pause >nul
set tu=!adname%acs%!
md specific_user\!tu!
md specific_user\!tu!\picture
md specific_user\!tu!\document
md specific_user\!tu!\audio
md specific_user\!tu!\video
set "tu="
@echo.::WARNING>>config_user\!adname%acs%!.settings
@echo.::>>config_user\!adname%acs%!.settings
@echo.::To avoid errors in Log OS, please don't edit this file>>config_user\!adname%acs%!.settings
@echo.::>>config_user\!adname%acs%!.settings
@echo.::Saved at : %date% %time%>>config_user\!adname%acs%!.settings
@echo.adname=!adname%acs%!,>>config_user\!adname%acs%!.settings
@echo.admincol=07,>>config_user\!adname%acs%!.settings
@echo.adminpass=!adminpass%acs%!,>>config_user\!adname%acs%!.settings
@echo.admindescript=!admindescript%acs%!,>>config_user\!adname%acs%!.settings
@echo.type=Administrator,>>config_user\!adname%acs%!.settings
:adsuccess
cls
Echo.
Echo Account creation successful
Echo.
set /p answer=Add more accounts? (Y/N)
if "%answer%"=="Y" goto newaccount
if "%answer%"=="y" goto newaccount
if "%answer%"=="N" goto logon
if "%answer%"=="n" goto logon
goto adsuccess

:newaccountadd
set /a ucs=%ucs%+1
cls
Echo.
Echo Welcome to new user setup
Echo.
Echo If you'd like to add a name and password, type them in. If you leave them
Echo blank, the user will have your computer's username and it will have no
Echo password (passwords are recommended tough).
Echo.
set /p userg%ucs%=Enter name:
if "!userg%ucs%!"=="" set userg%ucs%=%username%
set /p pp%ucs%=Enter password:
if "!pp%ucs%!"=="" set noupass%ucs%=true
cls
Echo.
Echo Enter in a description (optional)
Echo.
Echo Description will be shown in the start screen. Make it
Echo describe the account.
Echo.
set /p userdescription%ucs%=Enter the description:
cls
Echo.
Echo Verification
Echo.
Echo Please verify that the following information is correct:
Echo.
Echo Name: !userg%ucs%!
Echo Password: !pp%ucs%!
Echo Description: !userdescription%ucs%!
Echo.
Echo Please try again, when the info is not correct
Echo.
Pause >nul
set tu=!userg%ucs%!
md specific_user\!tu!
md specific_user\!tu!\picture
md specific_user\!tu!\document
md specific_user\!tu!\audio
md specific_user\!tu!\video
set "tu="
@echo.::WARNING>>config_user\!userg%ucs%!.settings
@echo.::>>config_user\!userg%ucs%!.settings
@echo.::To avoid errors in Log OS, please don't edit this file>>config_user\!userg%ucs%!.settings
@echo.::>>config_user\!userg%ucs%!.settings
@echo.::Saved at : %date% %time%>>config_user\!userg%ucs%!.settings
@echo.userg=!userg%ucs%!,>>config_user\!userg%ucs%!.settings
@echo.usercolor=07,>>config_user\!userg%ucs%!.settings
@echo.pp=!pp%ucs%!,>>config_user\!userg%ucs%!.settings
@echo.userdescription=!userdescription%ucs%!,>>config_user\!userg%ucs%!.settings
@echo.type=User,>>config_user\!userg%ucs%!.settings
:usuccess
cls
Echo.
Echo Account creation successful
Echo.
set /p answer=Add more accounts? (Y/N)
if "%answer%"=="Y" goto newaccount
if "%answer%"=="y" goto newaccount
if "%answer%"=="N" goto logon
if "%answer%"=="n" goto logon
goto usuccess



:changeaccount
if "%old%"=="false" goto newaccountadd
if not "%fullscreen%"=="true" mode %screen_w%,%screen_h%
if not "%live%"=="true" @echo Account creaton error>>log_os\log.txt
set userg=%username%
set pp=
cls
Echo.
Echo. Let's create a new account!
Echo.
Echo. First line is username and second is
Echo. password.
Echo.
Echo. If you leave lines blank, new user will
Echo. be with your name and with no password.
Echo. Description is used to describe the
Echo. purpose of the account you are creating.
Echo.
if exist bin_os\bg.exe bg cursor 1
set/puserg=Username:
set /p pp=Password:

:descriptions
if "%pp%"=="" set noupass=true
set userdescription=
set/puserdescription=Description
if exist bin_os\bg.exe bg cursor 0
cls
cls
cls
cls
cls
set description=%userdescription%
:almostdone
set answer5=Password:
set ip=Wrong password
set pm=Enter password
if %noguest% EQU true goto diffnumber
goto cba321
:diffnumber
set n=2
if %adno% EQU true goto alsaad
goto cba3210
:cba321
set n=3
if %adno% EQU true goto alsaad1
goto cba3210
:alsaad
set n=1
goto cba3210
:alsaad1
set n=2
:cba3210
set number=%n%
cls
Echo.
Echo. Make you sure the information is correct!
Echo.
Echo. Username    : %userg%
if "%pp%"=="" Echo. Password    : You don't have a password&set noupass=true
if not "%pp%"=="" Echo. Password    : You have a password&set noupass=false
Echo. Description : %description%
Echo.
Echo. If informations aren't correct please
Echo. try again. If you want to delete custom
Echo. user account, go to settings, user settings,
Echo. and Delete custom user account.
Pause>nul
if "%autologon%"=="enabled" set autologon=disabled
if exist log_os\log.txt del log_os\log.txt
cls
if "%returnsetup%"=="yes" goto setupautol
goto logon8

:logon8
goto logdinglogon

:sn
if "%constart%"=="true" Echo Setting variables
set logontime=%time%
set randomm=%random%
if exist log_os\Logonscreen del log_os\Logonscreen
if not "%alogon%"=="setupnow" cls
if "%pp%"=="" set "noupass=true"&set pass=You have password
if not "%pp%"=="" set "noupass=false"&set pass=You have no password
set user=%userg%
set description=%userdescription%
set rndcolor=%usercolor%
if "%hibernated%"=="true" goto lockscreen
goto welcome

:viewthatnote
set editable=%answer%
goto gnote

:notes
cls
echo.
echo * Notes *
echo.
echo Notes stored at /specific_user/%user%/document
echo ------------------------------------------------------
dir /b specific_user\%user%\document\*.txt
echo ------------------------------------------------------
echo.
set /p editable=Type file name to edit:
set "editable=specific_user\%user%\document\%editable%"
:gnote
cls
echo.
echo * Notes * [Commands: $exit, $undo, $clear, $open]
echo ------------------------------------------------------
echo Editing %editable%
echo ------------------------------------------------------
set restore=gnote
if exist %editable% type %editable%
bg cursor 1&set /p note=&bg cursor 0
if "%note%"=="$exit" goto start
if "%note%"=="$undo" goto undonote
if "%note%"=="$clear" del %editable%&goto gnote
if "%note%"=="$open" goto notes
@echo.%note%>>%editable%
goto gnote
:refresh
set note=%note%
goto gnote

:undonote
set /a algeb=0
for /f "delims=" %%a in (%editable%) do set /a algeb+=1
set /a blgeb=0
for /f "delims=" %%a in (%editable%) do (
set /a blgeb+=1
if !blgeb! == !algeb! goto gnote
if "!blgeb!"=="1" @echo.%%a>%editable%
if not "!blgeb!"=="1" @echo.%%a>>%editable%
)
goto gnote

:notes2
set gp32=false
goto start

:hiberrestart
del config_os\%OSname%.settings
call :savesetup
set "hibernotify="
:restart
set hibernated=false
color 07
ping localhost -n 1 >nul
color 08
ping localhost -n 1 >nul
cls
ping localhost -n 1 >nul
color 08
for /l %%a in (1 1 %blank_h%) do (
Echo.%blankspace%               
)
Echo.%blankspace%³    
Echo.%blankspace%³    
Echo.%blankspace%³ù    
Echo.%blankspace%³ùù   
Echo.%blankspace%ÀÄÄÄÄÄ
Echo.
Echo.%minispace%   Restarting..
ping localhost -n 1 >nul
color 07
ping localhost -n 1 >nul
color 0F
ping localhost -n 1 >nul
if exist log_os\log.txt del log_os\log.txt
if not "%live%"=="true" Echo. Restart error >>log_os\log.txt
call :wcall
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_user\Settings_are_here del log_user\Settings_are_here
if exist Loading_administrator_things del Loading_administrator_things
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_os\Logonscreen del log_os\Logonscreen
if exist temp.txt del temp.txt
if exist log_os\log.txt del log_os\log.txt
@echo Shutdown was successfull>>log_os\Shutdown
@echo.>>log_os\terminate
ping localhost -n 1 >nul
bg _kbd
set key=%errorlevel%
if "%key%"=="49" set console=true
@echo.::Ends sound driver>>log_os\terminate
taskkill /F /IM bg.exe 2>nul
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
::if exist log_os\lgr del log_os\lgr
start /b "" "%~dp0\LogOS.bat"
exit

:cmd
if "%user%"=="" cls&goto eCMD
Echo You don't have a access to eCMD
if "%ecmdaccess%"=="no" goto start
if "%gunlimited%"=="yes" goto eCMD
if "%user%" == "Guest" goto start
cls
goto eCMD
:cmd2
set returncmd=yes
Color %rndcolor%
Echo. Invalid command in eCMD >> log_os\log.txt
Echo.
Echo. Welcome to Extended CMD!!!
Echo.
Echo. Please enter command below
Echo.
:setcommand
if not "%*"=="" exit /b
if "%dash%"=="" Color %rndcolor%
if "%dash%"=="" set dash=true
if not "%ERRORLEVEL%"=="0" echo Warning: Command may not be executed correctly (Error code: %ERRORLEVEL%)&set "errorlevel="
@echo off
:lolcommand
if not "%*"=="" exit /b
bin_os\bg.exe cursor 1
if "%dash%"=="true" set/pcommand=%d%^>
if "%dash%"=="false" set/pcommand=
bin_os\bg.exe cursor 0
:Command
:Command2
if not "%1"=="" set "command=%*"
if "%command%"=="" exit /b
if "%command%"=="exit" set returncmd=no&set "dash="&set "d="&goto start
if "%command%"=="dir" dir /b&goto setcommand
if "%command%"=="help" Echo. exit  system  dir  reg  calculator  time&Echo. explorer  notes  settings  dance&Echo. fastnote  clear  open  eCMD  gedit&echo. print  execs  xc  note  bgfg  dash&echo. fullhelp peek apps&goto setcommand
if "%command%"=="fullhelp" (
echo.
echo eCMD command descriptions
echo.
echo exit - closes eCMD
echo system - different system operations
echo. system -Llogon - account operations
echo   system -Llogon +fixuser
echo   system -Llogon +newuser
echo   system -Llogon -deluser [username]
echo. system -[powerstate] - set system to a specific power state: -restart/-shutdown/-hibernate/-standby
echo.  system -restart [type] - restart type: +recovery/+hot/+cold
echo.  system -standby [type] - standby type: +hybrid/-hybrid
echo. system -noclose [bool] - set automatic restart setting
echo.  bool value can be +true or -false
echo. system -get - get a system attribute
echo.  system -get [attribute] - version/time
echo. system -files +corrupt - corrupts system files
echo. system -updateclose [bool]
echo. system -start - startup options
echo.  system -start +hang - hangs the system
echo.  system -start +addscreen - allows you to install a boot_os\bootscreen
echo.  system -start -delscreen - allows you to uninstall a boot_os\bootscreen
echo. system -showlogo - displays system logo
echo reg - register a variable
echo. reg [variable]
echo qreg - register a variable headlessly
echo. qreg [variable]=[value]
echo peek - display a value of a variable
echo  peek [variable] - shows a specific value of a variable
echo  peek boolean-data - shows all boolean variables
echo  peek - shows all variables
echo [internal_appname] - launches a system application
echo [external_appname] - launches an user application
echo apps -list - gets a list of external applications
echo clear - clears the screen
echo open - starts %OSname%
echo eCMD - starts eCMD
echo dash - command line prompt prefix
echo. on - enables command line prompt
echo. off - disables command line prompt
echo. clear - empties commmand line prompt
echo. [prefix] - sets command line prompt to a specified value
echo print [value] - displays a message
pause
echo println - outputs and empty line
echo execs [filename] - executes a command script
echo xc [command] - executes a Windows command
echo bgfg [bg][fg] - sets console color
echo. bg and fg are hex values 0-F
echo. execute "xc color /?" to see code descriptions
echo bootedit - edit startup configurations
echo. bootedit -makeconfig - create boot configuration file
echo. bootedit -eraseconfig - reset boot configuration
echo. bootedit -default [value] - set default boot option
echo. bootedit -timer [bool] - enable/disable timeout
echo. bootedit -timeout [value] - set timeout
echo. bootedit -copytheme - sets current user theme as the boot manager's theme
echo. bootedit -settheme [hexadecimal byte] - set the specified color code as the boot manager's theme
echo. bootedit -sethighlight [hexadecimal byte] - set the specified color code as the color for highlighted items
echo. bootedit -onrestart [+show/-hide] - show or hide the boot manager when restarting within internal OS
echo. bootedit -addentry [name] [kernel/bootloader path] [+internal/-internal] - add new entry
echo. bootedit -delentry [name] - deletes the entry with specified name
echo. bootedit -changeentry [entry name] [entry variable] [value] - edit a value on specified entry
echo.  e.g. bootedit -changeentry name Log OS 3.0    - sets name to Log OS 3.0
echo.       bootedit -changeentry debug sos          - adds debug mode option
echo.       bootedit -changeentry internal yes       - makes the entry internal
echo.       bootedit -changeentry path 2.7\LogOS.bat - sets the path for the specified entry
echo setsm [path with filename] - replace session manager
echo ressm - restore default session manager
echo setde [command] - set a startup command
echo delde - remove a startup command
echo help - displays all available commands
echo switch - skips next line[s] if specified variable does not match input
echo   switch [line count] [variable] [value]
echo fullhelp - shows all available commands, their descriptions and syntax
)
if "%command%"=="println" echo.&goto setcommand
if "%command:~0,5%"=="input" set/p%command:~6%=%d%
if "%command:~0,5%"=="input" goto setcommand
if "%command:~0,6%"=="switch" (
set commander=%command:~7%
set /a IDX=1
for %%a in (!commander!) do (
set "item!IDX!=%%a"
set /a IDX+=1
)
set variable=!item2!
set value=!item3!
set count=!item1!
if not "!variable!"=="!value!" set /a skip=!count!
if "!variable!"=="!value!" set /a skip=0
goto setcommand
)
if "%command%"=="pause" pause&goto setcommand
if "%command%"=="fullhelp" goto setcommand
if "%command%"=="system -Llogon +fixuser" goto fixnumber
if "%command%"=="system -Llogon +newuser" goto newaccount
if "%command%"=="system -Llogon -deluser" goto qdelaccount
if "%command%"=="system -hibernate" goto hiber
if "%command%"=="system -shutdown" set compat1=true&goto shutdown
if "%command%"=="system -restart" goto restart
if "%command%"=="system -restart +recovery" set /p reason=Enter reason:&goto sfrec
if "%command%"=="system -standby +hybrid" goto hybridsleep
if "%command%"=="system -standby -hybrid" goto standby
if "%command%"=="system -restart +hot" goto hoting
if "%command%"=="system -restart +cold" set/prst=Are you sure? (Y/N)&goto resetcold
if "%command%"=="system -noclose +true" set nos=true&Echo Command complited successfully&goto setcommand
if "%command%"=="system -noclose -false" set nos=&Echo Command complited successfully&goto setcommand
if "%command%"=="system -get time" Echo %time%&goto setcommand
if "%command%"=="system -files +corrupt" goto currupter
if "%command%"=="system -updateclose -false" goto disableuc
if "%command%"=="system -updateclose +true" goto enableuc
if "%command%"=="system -get version" call :passit&Echo LogOS %version%&goto setcommand
if "%command%"=="reg -fscreen for each now add resume=settings&set user=%user%" goto disablesf
if "%command%"=="reg +fscreen for each now add resume=settings&set user=%user%" goto enablesf
if "%command%"=="reg" echo Syntax error&goto setcommand
if "%command%"=="calculator" goto cal
if "%command%"=="time" goto time
if "%command%"=="explorer" goto fe
if "%command:~0,5%"=="notes" goto notestack
if "%command%"=="settings" goto setup
if "%command%"=="fastnote" goto edittir
if "%command%"=="dance" goto dance
if "%command%"=="apps -list" (
echo Listing installed applications:
set /a appid=1
for /f "delims=" %%a in ('dir /b apps_user apps_os') do (
if exist apps_user\%%a call apps_user\%%a -getinfo !appid!
if exist apps_user\%%a echo.   Executable: %%a
if not exist apps_user\%%a echo. System app: %%a
set /a appid+=1
)
)
if "%command:~0,11%"=="apps -launch" set answer=%command:~12%&goto customlogapp
if "%command%"=="clear" cls&goto setcommand
if "%command%"=="open" echo LogOS is already open&echo Try using "system -restart" instead&goto setcommand
if "%command%"=="system -start +hang" goto rain
if "%command%"=="eCMD" goto eCMD
if "%command%"=="system -start -delscreen" goto dbs
if "%command%"=="system -showlogo" echo E: Cannot display system logo&goto setcommand
if "%command%"=="gedit" goto geditor
if "%command%"=="?" goto help
if "%command:~0,21%"=="system -flash +update" set destination=%command:~22%&goto flashit
if "%command%"=="system -flash +update +ota" Echo Downloading latest software... (using FTP)&call :serverlol&echo Download complete. Checking compatiblity...&set destination=%homedrive%\LOGOS&goto flashit
if "%command%"=="dash on" set dash=true&goto setcommand
if "%command%"=="dash off" set dash=false&goto setcommand
if "%command%"=="dash clear" set "d="&goto setcommand
if "%command%"=="" goto setcommand
if "%command%"=="dash" echo dash=%dash%&goto setcommand
if "%command:~0,24%"=="system -start +addscreen" goto cbs
if "%command:~0,18%"=="system -makedomain" SET domain=%command:~19%&@echo.domain=%command:~19%,>>config_os\%OSname%.settings&echo Commmand complited successfully&goto setcommand
if "%command:~0,6%"=="system" echo Syntax error&goto setcommand
if "%command:~0,4%"=="dash" set d=%command:~5%&goto setcommand
if "%command:~0,5%"=="print" (
set "sc=!command:~6!"
set "sc=!command:~6!"
if not "!sc:adminpass=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
if not "!sc:pp=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
if not "!sc:pq=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
if not "!sc:userg=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
if not "!sc:adname=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
if not "!sc:rndcolor=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
if not "!sc:usercolor=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
if not "!sc:admincol=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
if not "!sc:guestcolor=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
if not "!sc:loginname=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
if not "!sc:autologon=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
if not "!sc:adno=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
if not "!sc:noguest=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
if not "!sc:userdescription=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
if not "!sc:admindescript=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
if not "!sc:nopass=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
if not "!sc:noupass=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
if not "!sc:domain=a!"=="!sc!" echo Command not allowed. Please use 'peek' instead.&goto setcommand
Echo.%command:~6%&goto setcommand
)
if "%command:~0,5%"=="Print" Echo %command:~6%&goto setcommand
if "%command:~0,5%"=="PRINT" Echo %command:~6%&goto setcommand
if "%command:~0,5%"=="execs" goto executenow
if "%command:~0,5%"=="exeCS" goto executenow
if "%command:~0,5%"=="eXeCS" goto executenow
if "%command:~0,5%"=="EXECS" goto executenow
if "%command:~0,5%"=="Execs" goto executenow
if "%command:~0,5%"=="execs" goto executenow
if "%command:~0,2%"=="xc" goto xclol
if "%command:~0,4%"=="note" goto setcommand
if "%command:~0,4%"=="bgfg" color %command:~5%&goto setcommand
if "%command:~0,4%"=="peek" (
	if "!user!"=="!adname!" (
		if "%command:~5%"=="boolean-data" (
			echo ---------------------------------------------------------------
			echo Peeking all boolean variables
			echo ---------------------------------------------------------------
			for /f "tokens=1-3 delims==" %%a in ('set') do (
				if "%%b"=="true" echo %%%%a%% is set to "%%b"
				if "%%b"=="false" echo %%%%a%% is set to "%%b"
				if "%%b"=="yes" echo %%%%a%% is set to "%%b"
				if "%%b"=="no" echo %%%%a%% is set to "%%b"
				if "%%b"=="enabled" echo %%%%a%% is set to "%%b"
				if "%%b"=="disabled" echo %%%%a%% is set to "%%b"
			)
			echo ---------------------------------------------------------------
			goto setcommand
		)
		if not "%command:~5%"=="" echo %%!command:~5!%% is currently set to "!%command:~5%!"&goto setcommand
		if "%command:~5%"=="" (
			set /a IDX=0
			set /a SET=1
			echo ---------------------------------------------------------------
			echo Peeking all variables
			echo ---------------------------------------------------------------
			for /f "tokens=1-3 delims==" %%a in ('set') do (
				set /a IDX+=1
				echo %%%%a%% is currently set to "%%b"
				if "!IDX!"=="33" echo ---------------------------------------------------------------&echo Set !SET!&pause&echo ---------------------------------------------------------------&set /a SET+=1&set /a IDX=0
			)
			echo ---------------------------------------------------------------
			echo Set !SET!
			echo ---------------------------------------------------------------
			goto setcommand
		)
	) else (
		echo You do not have permission to use this command.
		echo Command failed to complite successfully.
		goto setcommand
	)
)
if "%command:~0,4%"=="qreg" set "%command:~5%"&goto setcommand
if "%command:~0,3%"=="reg" (
if "!user!"=="!adname!" (
set /p !command:~4!=%%!command:~4!%%=&echo Command complited successfully&goto setcommand
) else (
echo You do not have permission to use this command.
echo Command failed to complite successfully.
goto setcommand
)
)
if "%command:~0,5%"=="setde" @echo %command:~6%>config_os\de.setting
if "%command:~0,5%"=="setde" echo Desktop environment set to %command:~6%&echo Command complited successfully&goto setcommand
if "%command%"=="delde" (
if exist config_os\de.setting del config_os\de.setting&echo The desktop environment has been restored to default&echo Command complited successfully&goto setcommand
if not exist config_os\de.setting echo E: File does not exist&echo Command failed to complite successfully&goto setcommand
)
set answer=%command%
if not "%*"=="" goto :eof
goto anywaydot
:xclol
if not "%user%"=="" (
if "%user%"=="%userg%" echo Standard users nor guests can access this command&echo Command failed to complite successfully&goto setcommand
if "%user%"=="Guest" echo Standard users nor guests can access this command&echo Command failed to complite successfully&goto setcommand
)
%command:~3%
goto setcommand
:executenow
set cfile=%command:~6%
:knowncfile
set /a skip=0
if not "%user%"=="" (
if "%user%"=="%userg%" echo Standard users nor guests can access this command&echo Command failed to complite successfully&goto setcommand
if "%user%"=="Guest" echo Standard users nor guests can access this command&echo Command failed to complite successfully&goto setcommand
)
if exist %cfile%.cs set cfile=%cfile%.cs
if not exist %cfile% Echo E: Scriptfile %cfile% does not exist&goto setcommand
set cs=true
set "command="
for /f "delims=" %%a in (%cfile%) do (
set "temp=%%a"
set "temp=!temp:	=!"
if !skip! LEQ 0 (
call :Command2 !temp!
) else (
set /a skip-=1
)
)
set cs=false
if "%endscript%"=="true" goto :eof
echo Command script finished
goto setcommand
:setcommandfinish
set answer=
if exist "%command%" cmd /k %command%&goto setcommand
Echo Bad file or command name
goto setcommand

:resetcold
if "%rst%"=="Y" set "rst="&goto resetcoldnow
if "%rst%"=="y" set "rst="&goto resetcoldnow
set errorlevel=1
goto setcommand

:resetcoldnow
Echo Erasing...
call :wcall
del config_os\%OSname%.settings
del boot_os\logos_logo.bat
@echo.>>log_os\terminate
ping localhost -n 2 >nul
del boot_os\Sound.bat
if exist log_os\terminate del log_os\terminate
set bootloader=true
set recover=false
goto wud3

:notestack
set editable=%command:~5%
if not exist %editable% goto notes
goto gnote

:enableuc
set noqs=false
goto setcommand

:disableuc
set noqs=true
Echo Command complited successfully
goto setcommand

:currupter
set userg=%random%
set ip=%random%
set rndcolor=%random%
set adminpass=%random%
set answer5=%random%
set pw=%random%
set pp=%random%
set userdescription=%random%
set hibernated=%random%
set restore=%random%
set logoncolor=1F
set usercolor=4F
set admincol=2F
set guestcolor=9F
set noguest=%random%
set adname=%random%
set adno=%random%
set adname=%random%
set admindescript=%random%
set classic=true
set fullscreen=true
set autologon=false
set loginname=%random%
set nopass=true
set noupass=true
set compatibility=no
echo ::WARNING!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
::

@echo ip=%ip%,>> config_os\%OSname%.settings
@echo rndcolor=%rndcolor%,>> config_os\%OSname%.settings
@echo adminpass=%adminpass%,>> config_os\%OSname%.settings



@echo hibernated=%hibernated%,>>config_os\%OSname%.settings
@echo restore=%restore%,>>config_os\%OSname%.settings
@echo t=%t%,>>config_os\%OSname%.settings

@echo admincol=%admincol%,>>config_os\%OSname%.settings
@echo logoncolor=%logoncolor%,>>config_os\%OSname%.settings
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings
@echo factory=no,>> config_os\%OSname%.settings
@echo noguest=%noguest%,>> config_os\%OSname%.settings
@echo autoreset=%autoreset%,>>config_os\%OSname%.settings
@echo adno=%adno%,>>config_os\%OSname%.settings
@echo adname=%adname%,>>config_os\%OSname%.settings
@echo admindescript=%admindescript%,>>config_os\%OSname%.settings
@echo classic=%classic%,>>config_os\%OSname%.settings
@echo autologon=%autologon%,>>config_os\%OSname%.settings
@echo loginname=%loginname%,>>config_os\%OSname%.settings
@echo nopass=%nopass%,>>config_os\%OSname%.settings
@echo noupass=%noupass%,>>config_os\%OSname%.settings
@echo compatibility=%compatibility%,>>config_os\%OSname%.settings
@echo oldstart=%oldstart%,>> config_os\%OSname%.settings
::@echo resolution=%resolution%,>>config_os\%OSname%.settings
@echo constart=%constart%,>>config_os\%OSname%.settings
call :wcall
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if exist log_os\lgr del log_os\lgr
start /b "" %0
exit

:qdelaccount
Echo Deleting user account
if "%live%"=="yes" goto yest
call :savesetup
if "%domain%" NEQ "logos_settings" call :checkansavedomain
:yest
Echo To complite delete please log off
if exist log_os\log.txt del log_os\log.txt
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
Echo Command complited successfully
goto setcommand

:fixnumber
set n=
set gn=
set an=
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if "%adno%"=="true" goto checkmorenumbers
if "%noguest%"=="true" set n=2&goto cba32101
set n=3
goto cba32101

:checkmorenumbers
if "%noguest%"=="true" set n=1&goto cba32101
set /a gn=0+1
set n=2
goto cba32101
:cba32101
if "%logonisen%"=="true" set logonisen=false&goto logon
Echo.
Echo User number changed successfully.
Echo Log off to see changes.
Echo.
Echo Command complited successfully
goto setcommand
:rain
if "%adno%"=="true" goto start
Echo rain: 0x58229533
Echo adminpass=none but nopass=no
:rainer
goto rainer

:rain2
goto logon

:bootoption
cls
Echo.
Echo. Boot device menu
Echo.
Echo. Select proper boot device:
Echo.
Echo. 1. %0 (default)
Echo. 2. Custom
Echo.
Echo. To enter BIOS, do the following:
Echo.  - Count how long OS boots in your computer
Echo.  - Shut down Log OS and start it, but start holding DELETE key
Echo.  - Hold as long as you counted it boots
Echo.  - Release right when the counted time ends
Echo.  - If done right, BI/OS Utility will appear
Echo.
bg kbd
set key=%errorlevel%
if "%key%"=="50" goto special
if "%key%"=="49" goto startlogos
goto bootoption

:startlogos
set "stagar="
set "setup="
start /b "" %0
exit

:tempset
color 08
cls
Echo.
Echo. Log OS B I/O S Utility
Echo.
Echo. 1. Specify boot device
Echo.    Specifies system location
Echo. 2. I/O test
Echo.    Test reading and writing to the disk
Echo. 3. Version info
Echo.    Displays current system info
Echo. 4. Inject BIOS
Echo.    Removes BIOS variable from the memory
Echo.
ping localhost -n 1 >nul
color 07
ping localhost -n 1 >nul
color 0F
:lolset
bg kbd
set key=%errorlevel%
if "%key%"=="52" goto in
if "%key%"=="51" goto ver_info
if "%key%"=="50" goto iot
if "%key%"=="49" goto special
goto lolset

:in
set "setup="
set "stagar="
start /b "" %0
exit

:iot
cls
Echo.
Echo. Log OS B I/O S Utility
Echo.
Echo. Writing test (10 bytes)
@echo.123%screen_h%67890>>test
Echo. Deleting test (10 bytes)
if exist test set ts=1
del test
if not exist test set ts=2
if "%ts%"=="2" Echo. Test succeeded
if "%ts%"=="1" Echo. Write test succeeded
if "%ts%"=="1" Echo. Deletion failed
if "%ts%"=="" Echo. Test failed
ping localhost -n 4 >nul
color 07
ping localhost -n 1 >nul
color 08
ping localhost -n 1 >nul
cls
ping localhost -n 1 >nul
call :wcall
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if exist log_os\lgr del log_os\lgr
start /b "" %0
exit

:ver_info
cls
Echo.
Echo. Log OS B I/O S Utility
Echo.
call :passit
Echo. Version: %version%
Echo. Open password: %opasswd%
Echo. Result: %flashresult%
Echo. Edition: %edition%
Echo. Default boot device: %system%
Echo. Installation type: %type%
if not "%oem%"=="none" Echo. OEM: %oem%
if "%oem%"=="non" Echo. No OEM detected
ping localhost -n 10 >nul
color 07
ping localhost -n 1 >nul
color 08
ping localhost -n 1 >nul
cls
ping localhost -n 1 >nul
call :wcall
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if exist log_os\lgr del log_os\lgr
start /b "" %0
exit
:special
cls
Echo.
Echo. Log OS B I/O S Utility
Echo.
set /p device=Enter boot device:
cls
Echo.
Echo. Log OS B I/O S Utility
Echo.
start /b %device%
if exist log_os\lgr del log_os\lgr
exit
:dbs
color 4F
Echo Deleting boot_os\bootscreen files...
if exist boot_os\bootscreen0.cmd del boot_os\bootscreen0.cmd
if exist boot_os\bootscreen1.cmd del boot_os\bootscreen1.cmd
if exist boot_os\bootscreen2.cmd del boot_os\bootscreen2.cmd
if exist boot_os\bootscreen3.cmd del boot_os\bootscreen3.cmd
if exist boot_os\bootscreen4.cmd del boot_os\bootscreen4.cmd
if exist boot_os\bootscreen5.cmd del boot_os\bootscreen5.cmd
if exist boot_os\bootscreen6.cmd del boot_os\bootscreen6.cmd
if exist boot_os\bootscreen7.cmd del boot_os\bootscreen7.cmd
if exist boot_os\bootscreen8.cmd del boot_os\bootscreen8.cmd
if exist boot_os\bootscreen9.cmd del boot_os\bootscreen9.cmd
if exist boot_os\bootscreen10.cmd del boot_os\bootscreen10.cmd
if exist boot_os\bootscreen11.cmd del boot_os\bootscreen11.cmd
if exist boot_os\bootscreen12.cmd del boot_os\bootscreen12.cmd
if exist boot_os\bootscreen13.cmd del boot_os\bootscreen13.cmd
if exist boot_os\bootscreen14.cmd del boot_os\bootscreen14.cmd
if exist boot_os\bootscreen15.cmd del boot_os\bootscreen15.cmd
if exist boot_os\bootscreen16.cmd del boot_os\bootscreen16.cmd
if exist boot_os\bootscreen17.cmd del boot_os\bootscreen17.cmd
if exist boot_os\bootscreen18.cmd del boot_os\bootscreen18.cmd
if exist boot_os\bootscreen19.cmd del boot_os\bootscreen19.cmd
if exist boot_os\bootscreen20.cmd del boot_os\bootscreen20.cmd
Echo Checking...
if exist boot_os\bootscreen0.cmd goto dbserror
if exist boot_os\bootscreen1.cmd goto dbserror
if exist boot_os\bootscreen2.cmd goto dbserror
if exist boot_os\bootscreen3.cmd goto dbserror
if exist boot_os\bootscreen4.cmd goto dbserror
if exist boot_os\bootscreen5.cmd goto dbserror
if exist boot_os\bootscreen6.cmd goto dbserror
if exist boot_os\bootscreen7.cmd goto dbserror
if exist boot_os\bootscreen8.cmd goto dbserror
if exist boot_os\bootscreen9.cmd goto dbserror
if exist boot_os\bootscreen10.cmd goto dbserror
if exist boot_os\bootscreen11.cmd goto dbserror
if exist boot_os\bootscreen12.cmd goto dbserror
if exist boot_os\bootscreen13.cmd goto dbserror
if exist boot_os\bootscreen14.cmd goto dbserror
if exist boot_os\bootscreen15.cmd goto dbserror
if exist boot_os\bootscreen16.cmd goto dbserror
if exist boot_os\bootscreen17.cmd goto dbserror
if exist boot_os\bootscreen18.cmd goto dbserror
if exist boot_os\bootscreen19.cmd goto dbserror
if exist boot_os\bootscreen20.cmd goto dbserror
Echo.
Echo No errors.
Echo.
echo Command complited successfully
goto setcommand

:dbs
if exist log_os\log.txt del log_os\log.txt
cls
mode %screen_w%,%screen_h%
cls
color 1F
Echo.
Echo It looks like LogOS occurred a problem and
Echo needs to be closed to prevent damage to
Echo OS itself.
Echo.
Echo Try restarting LogOS. If this screen appears
Echo again follow these steps:
Echo.
Echo Check to make sure you are using Read/Write
Echo media (e.g. Hard disk, CD-RW, flash drive etc.)
Echo.
Echo Also try loading specific drivers from driver
Echo disk for this operating system by going to safe
Echo mode by pressing S key when Log OS logo show at
Echo the startup.
Echo.
Echo Dumping LogOS...
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if not "%now%"=="sklm" ping localhost -n 1 >nul
if not "%live%"=="true" @echo. Error 1: Optical or Read-only media>>log_os\log.txt
if not "%now%"=="sklm" ping localhost -n 1 >nul
if exist log_os\log.txt del log_os\log.txt
if exist bin_os\bg.exe bg.exe cursor 0
@echo.goto fixerrors>>log_os\Shutdown
echo ::WARNING!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
::

@echo ip=%ip%,>> config_os\%OSname%.settings
if "%rndcolor%"=="" set rndcolor=07
@echo rndcolor=%rndcolor%,>> config_os\%OSname%.settings
if "%adminpass%"=="" set adminpass=administratorhasmanyrights
@echo adminpass=%adminpass%,>> config_os\%OSname%.settings


if "%hibernated%"=="" set hibernated=false
@echo restore=%restore%,>>config_os\%OSname%.settings
if "%usercolor%"=="" set usercolor=07

if "%admincol%"=="" set admincol=07
@echo admincol=%admincol%,>>config_os\%OSname%.settings
if "%logoncolor%"=="" set logoncolor=07
@echo logoncolor=%logoncolor%,>>config_os\%OSname%.settings
if "%guestcolor%"=="" set guestcolor=07
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings
if "%factory%"=="" set factory=no
@echo factory=no,>> config_os\%OSname%.settings
if "%noguest%"=="" set noguest=false
@echo noguest=%noguest%,>> config_os\%OSname%.settings
if "%autoreset%"=="" set autoreset=true
@echo autoreset=%autoreset%,>>config_os\%OSname%.settings
if "%adno%"=="" set adno=false
@echo adno=%adno%,>>config_os\%OSname%.settings
if "%adname%"=="" set adname=Administrator
@echo adname=%adname%,>>config_os\%OSname%.settings
@echo admindescript=%admindescript%,>>config_os\%OSname%.settings
if "%classic%"=="" set classic=false
@echo classic=%classic%,>>config_os\%OSname%.settings
if "%autologon%"=="" set autologon=false
@echo autologon=%autologon%,>>config_os\%OSname%.settings
@echo loginname=%loginname%,>>config_os\%OSname%.settings
if "%nopass%"=="" set nopass=no
if "%noupass%"=="" set noupass=false
@echo nopass=%nopass%,>>config_os\%OSname%.settings
@echo noupass=%noupass%,>>config_os\%OSname%.settings
@echo compatibility=no,>>config_os\%OSname%.settings
if "%domain%"=="" set domain=logos_settings
if "%domain%"=="logos_settings" @echo domain=logos_settings,>>config_os\%OSname%.settings
if "%resolution%"=="" set resolution=seven
::@echo resolution=%resolution%,>>config_os\%OSname%.settings
@echo constart=%constart%,>>config_os\%OSname%.settings
if "%sounded%"=="" set sounded=true
@echo sounded=%sounded%,>>config_os\%OSname%.settings
@echo oldstart=%oldstart%,>> config_os\%OSname%.settings
call :wcall
Echo Dump complited.
if exist log_os\lgr del log_os\lgr
if "%autoreset%"=="true" start /b "" %0
if "%autoreset%"=="true" exit
:sebe
goto sebe
:cbserror
echo File does not exist
echo Command was not completed successfully
goto setcommand
:cbs
set path=%command:~25%
if not exist %path% goto cbserror
color 4F
Echo.
Echo. LogOS command recovery
Echo.
Echo.
Echo Execute
Echo.
Echo. Wipe cache
SET userg=
SET n=
SET ip=
SET rndcolor=
SET adminpass=
SET answer5=
SET pw=
SET pp=
SET userdescription=
set hibernated=
set restore=
set usercolor=
set admincol=
set logoncolor=
set guestcolor=
SET factory=
SET noguest=
SET autoreset=
SET adno=
SET an=
SET gn=
SET adname=
SET admindescript=
SET classic=
SET fullscreen=
SET autologon=
SET loginname=
SET nopass=
SET noupass=
SET compatibility=
SET compat=
SET slogo=
SET recoveryaccess=
SET domain=
SET domainusername=
SET domaincolor=
SET domainpassword=
SET domaindescription=
SET resolution=
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
Echo. Create Shutdown
@echo.>>log_os\Shutdown
Echo. Delete previous boot kernel
if exist boot_os\bootscreen0.cmd del boot_os\bootscreen0.cmd
if exist boot_os\bootscreen1.cmd del boot_os\bootscreen1.cmd
if exist boot_os\bootscreen2.cmd del boot_os\bootscreen2.cmd
if exist boot_os\bootscreen3.cmd del boot_os\bootscreen3.cmd
if exist boot_os\bootscreen4.cmd del boot_os\bootscreen4.cmd
if exist boot_os\bootscreen5.cmd del boot_os\bootscreen5.cmd
if exist boot_os\bootscreen6.cmd del boot_os\bootscreen6.cmd
if exist boot_os\bootscreen7.cmd del boot_os\bootscreen7.cmd
if exist boot_os\bootscreen8.cmd del boot_os\bootscreen8.cmd
if exist boot_os\bootscreen9.cmd del boot_os\bootscreen9.cmd
if exist boot_os\bootscreen10.cmd del boot_os\bootscreen10.cmd
if exist boot_os\bootscreen11.cmd del boot_os\bootscreen11.cmd
if exist boot_os\bootscreen12.cmd del boot_os\bootscreen12.cmd
if exist boot_os\bootscreen13.cmd del boot_os\bootscreen13.cmd
if exist boot_os\bootscreen14.cmd del boot_os\bootscreen14.cmd
if exist boot_os\bootscreen15.cmd del boot_os\bootscreen15.cmd
if exist boot_os\bootscreen16.cmd del boot_os\bootscreen16.cmd
if exist boot_os\bootscreen17.cmd del boot_os\bootscreen17.cmd
if exist boot_os\bootscreen18.cmd del boot_os\bootscreen18.cmd
if exist boot_os\bootscreen19.cmd del boot_os\bootscreen19.cmd
if exist boot_os\bootscreen20.cmd del boot_os\bootscreen20.cmd
Echo. Replace boot kernel
copy "%path%\boot_os\bootscreen*" "%cd%"
:skipffcbs
Echo. Set variable
set quickstart=true
Echo.
Echo. Endlocal executing finished
Echo.
Echo.
Echo Now you need to cold reboot %OSname%.
Echo To do this please start %OSname%.bat
Echo manually after pressing any key. If
Echo you press any key, system will shut
Echo down automatically.
Pause
if "%noqs%"=="yes" set quickstart=false
if not exist "%path%" ansicon -m0C -e Error: Directory not found
if exist "%path%" Echo Command complited successfully
color 07
goto start

:eCMD
if exist bin_os\bg.exe bg cursor 1
Echo eCMD version 1.2
set command=help
goto cmd2 
 

:specialsmd
if not "%startscript%"=="true" (
Echo.
Echo. Welcome to Extended CMD!!!
Echo.
Echo. Please enter command below
Echo.
)
:scommsystem
bin_os\bg.exe cursor 1
set/pcommand=%cd%^>
bin_os\bg.exe cursor 0
goto command2s

:command2s
%command%
goto scommsystem

:star83
cls
if not "%live%"=="true" @echo Batch job log_os\terminated>>log_os\log.txt
Echo.
Echo log_os\terminate/end crazygame first,then open up this window
Echo.
start /wait crazygame.bat
if exist log_os\log.txt del log_os\log.txt
goto start

:hiber
title Saving state...
color 07
ping localhost -n 1 >nul
color 08
ping localhost -n 1 >nul
cls
ping localhost -n 1 >nul
color 08
for /l %%a in (1 1 %blank_h%) do (
Echo.%blankspace%               
)
Echo.%blankspace%³    
Echo.%blankspace%³    
Echo.%blankspace%³ù    
Echo.%blankspace%³ùù   
Echo.%blankspace%ÀÄÄÄÄÄ
Echo.
Echo.%minispace% Saving session...
ping localhost -n 1 >nul
color 07
ping localhost -n 1 >nul
color 0F
ping localhost -n 1 >nul
if exist bin_os\bg.exe bg.exe cursor 0
@echo.>>log_os\terminate
if not "%now%"=="sklm" ping localhost -n 1 >nul
set hibernated=true
if "%live%"=="true" goto slolhiber
:hibergay
if exist log_os\Logonscreen del log_os\Logonscreen
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\log.txt del log_os\log.txt
if exist save del save
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
echo :: WARNING^^!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo :: To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo :: Hibernated at : %date% %time%>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
for /f "delims=" %%a in ('set') do echo %%a,>>config_os\%OSname%.settings&ping localhost -n 1 >nul&ping localhost -n 1 >nul
ping localhost -n 1 >nul
color 07
ping localhost -n 1 >nul
color 08
ping localhost -n 1 >nul
cls
ping localhost -n 1 >nul
:slolhiber
title Welcome %user% to %OSname%
if not "%now%"=="sklm" ping localhost -n 1 >nul
@echo Shutdown was successfull>>log_os\Shutdown
:anos
if "%nos%"=="true" goto anos
call :wcall
color %rndcolor%
for /f "delims==" %%a in ('set') do cls&set %%a=
@echo.::Ends sound driver>>log_os\terminate
taskkill /F /IM bg.exe 2>nul
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
if exist log_os\lgr del log_os\lgr
exit

:lastfade
bg font 6
mode %screen_w%,%screen_h%
color %logoncolor%
if "%now%"=="true" goto %restore%
if "%domain%"=="" set domain=logos_settings
if "%restore%"=="key" del log_os\Shutdown&goto start
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
del log_os\Shutdown
goto %restore%

:key
goto start

:lastsession
:lstlol
if not "%live%"=="true" @echo. Unsafe state while restoring hibernate data>>log_os\log.txt
set reason=R_key
set hibernated=false
if "%restore%"=="" set restore=key
title Welcome back %user% to %OSname%
echo ::WARNING!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
::
if "%sos%"=="true" title Saving username

if "%sos%"=="true" title Saving user number
if "%sos%"=="true" title Saving incorrect message
@echo ip=%ip%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving safe mode color
@echo rndcolor=%rndcolor%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving administrator's password
@echo adminpass=%adminpass%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving plugins

if "%sos%"=="true" title Saving user description

if "%sos%"=="true" title Saving hibernate state
@echo hibernated=false,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving hibernaet restore variable
@echo restore=%restore%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Setting time
set t=
if "%sos%"=="true" title Saving user color

if "%sos%"=="true" title Saving admin color
@echo admincol=%admincol%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving guest color
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving factory settings
@echo factory=no,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving guest settigns
@echo noguest=%noguest%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving logon color
@echo logoncolor=%logoncolor%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving autoreset setting
@echo autoreset=%autoreset%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving admin's name
@echo adname=%adname%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving administrator settings
@echo adno=%adno%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving administrator's description
@echo admindescript=%admindescript%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving classic logon setting
@echo classic=%classic%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving autologon setting
@echo autologon=%autologon%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving autologon name variable
@echo loginname=%loginname%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving nopass settings
@echo nopass=%nopass%,>>config_os\%OSname%.settings
@echo noupass=%noupass%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving compatibility
@echo compatibility=%compatibility%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving resolution
::@echo resolution=%resolution%,>>config_os\%OSname%.settings
@echo constart=%constart%,>>config_os\%OSname%.settings
@echo sounded=%sounded%,>>config_os\%OSname%.settings
@echo oldstart=%oldstart%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Setting colors
@echo.>>log_os\Shutdown
goto :eof

:sfe2
cls
color %rndcolor%
Echo.
Echo Your computer was hibernated
Echo.
Echo To run it in safe mode you need
Echo to delete hibernate data
Echo.
set /panswer=Are you sure you want to run safe mode?(Y/N)
cls
if "%answer%"=="Y" goto remhib
if "%answer%"=="y" goto remhib
if "%answer%"=="N" goto lastsession
if "%answer%"=="n" goto lastsession
goto sfe2

:remhib
@echo hibernated=false,>>config_os\%OSname%.settings
@echo restore=,>>config_os\%OSname%.settings
goto safemode
:factory
if "%user%" == "Guest" goto factoryerror
if "%nopass%"=="yes" goto factory2
if "%noupass%"=="true" goto factory2
cls
set/panswer=Enter your password to confirm:
cls
if %answer%==%pp% goto factory2
if %answer%==%adminpass% goto factory2

goto factory

:driverbug
bg cursor 0
@echo.goto fixerrors>>log_os\Shutdown
echo ::WARNING!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
::

@echo ip=%ip%,>> config_os\%OSname%.settings
if "%rndcolor%"=="" set rndcolor=07
@echo rndcolor=%rndcolor%,>> config_os\%OSname%.settings
if "%adminpass%"=="" set adminpass=administratorhasmanyrights
@echo adminpass=%adminpass%,>> config_os\%OSname%.settings


if "%hibernated%"=="" set hibernated=false
@echo restore=%restore%,>>config_os\%OSname%.settings
if "%usercolor%"=="" set usercolor=07

if "%admincol%"=="" set admincol=07
@echo admincol=%admincol%,>>config_os\%OSname%.settings
if "%logoncolor%"=="" set logoncolor=07
@echo logoncolor=%logoncolor%,>>config_os\%OSname%.settings
if "%guestcolor%"=="" set guestcolor=07
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings
if "%factory%"=="" set factory=no
@echo factory=no,>> config_os\%OSname%.settings
if "%noguest%"=="" set noguest=false
@echo noguest=%noguest%,>> config_os\%OSname%.settings
if "%autoreset%"=="" set autoreset=true
@echo autoreset=%autoreset%,>>config_os\%OSname%.settings
if "%adno%"=="" set adno=false
@echo adno=%adno%,>>config_os\%OSname%.settings
if "%adname%"=="" set adname=Administrator
@echo adname=%adname%,>>config_os\%OSname%.settings
@echo admindescript=%admindescript%,>>config_os\%OSname%.settings
if "%classic%"=="" set classic=false
@echo classic=%classic%,>>config_os\%OSname%.settings
if "%fullscreen%"=="" set fullscreen=false
if "%autologon%"=="" set autologon=false
@echo autologon=%autologon%,>>config_os\%OSname%.settings
@echo loginname=%loginname%,>>config_os\%OSname%.settings
if "%nopass%"=="" set nopass=no
if "%noupass%"=="" set noupass=false
@echo nopass=%nopass%,>>config_os\%OSname%.settings
@echo noupass=%noupass%,>>config_os\%OSname%.settings
@echo compatibility=no,>>config_os\%OSname%.settings
if "%domain%"=="" set domain=logos_settings
if "%domain%"=="logos_settings" @echo domain=logos_settings,>>config_os\%OSname%.settings
if "%resolution%"=="" set resolution=seven
::@echo resolution=%resolution%,>>config_os\%OSname%.settings
if "%constart%"=="" set constart=false
if "%skiplogos%"=="true" set constart=true
if "%sounded%"=="" set sounded=true
@echo constart=%constart%,>>config_os\%OSname%.settings
@echo sounded=%sounded%,>>config_os\%OSname%.settings
@echo oldstart=%oldstart%,>> config_os\%OSname%.settings
call :wcall
if exist log_os\lgr del log_os\lgr
if "%autoreset%"=="true" start /b "" %0
if "%autoreset%"=="true" exit
:ilo
goto ilo
:somethingwentwrong
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Perform system refresh (2 times if neccessary)
Echo. - Perform factory reset
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback.html
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E001 - Errorlevel not less or equal
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E001 - Errorlevel not less or equal>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look


:recoveryerror
title Preparing Log OS for first use...
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if not "%now%"=="sklm" ping localhost -n 1 >nul
if not "%now%"=="sklm" ping localhost -n 1 >nul
if exist log_os\log.txt del log_os\log.txt
if not "%live%"=="true" Echo. Error 010 UNKNOWN VARIABLES>>log_os\log.txt
if exist bin_os\bg.exe bg.exe cursor 0
@echo.goto fixerrors>>log_os\Shutdown
echo ::WARNING!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
if "%rndcolor%"=="" set rndcolor=07
@echo rndcolor=%rndcolor%,>> config_os\%OSname%.settings
if "%adminpass%"=="" set adminpass=administratorhasmanyrights


if "%hibernated%"=="" set hibernated=false
@echo restore=%restore%,>>config_os\%OSname%.settings
if "%usercolor%"=="" set usercolor=07

if "%admincol%"=="" set admincol=07
@echo admincol=%admincol%,>>config_os\%OSname%.settings
if "%logoncolor%"=="" set logoncolor=07
@echo logoncolor=%logoncolor%,>>config_os\%OSname%.settings
if "%guestcolor%"=="" set guestcolor=07
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings
if "%factory%"=="" set factory=no
@echo factory=no,>> config_os\%OSname%.settings
if "%noguest%"=="" set noguest=false
@echo noguest=%noguest%,>> config_os\%OSname%.settings
if "%autoreset%"=="" set autoreset=true
@echo autoreset=%autoreset%,>>config_os\%OSname%.settings
if "%adno%"=="" set adno=false
@echo adno=%adno%,>>config_os\%OSname%.settings
if "%adname%"=="" set adname=Administrator
@echo adname=%adname%,>>config_os\%OSname%.settings
@echo admindescript=%admindescript%,>>config_os\%OSname%.settings
@echo customize=no,>>config_os\%OSname%.settings
if "%classic%"=="" set classic=false
@echo classic=%classic%,>>config_os\%OSname%.settings
if "%autologon%"=="" set autologon=false
@echo autologon=%autologon%,>>config_os\%OSname%.settings
@echo loginname=%loginname%,>>config_os\%OSname%.settings
if "%nopass%"=="" set nopass=no
if "%noupass%"=="" set noupass=false
@echo nopass=%nopass%,>>config_os\%OSname%.settings
@echo noupass=%noupass%,>>config_os\%OSname%.settings
@echo compatibility=no,>>config_os\%OSname%.settings
if "%domain%"=="" set domain=logos_settings
if "%domain%"=="logos_settings" @echo domain=logos_settings,>>config_os\%OSname%.settings
if "%resolution%"=="" set resolution=seven
ping localhost -n 1 >nul
if "%constart%"=="" set constart=false
if "%skiplogos%"=="true" set constart=true
if "%sounded%"=="" set sounded=true
@echo sounded=%sounded%,>>config_os\%OSname%.settings
@echo constart=%constart%,>>config_os\%OSname%.settings
@echo oldstart=%oldstart%,>> config_os\%OSname%.settings
::@echo resolution=%resolution%,>>config_os\%OSname%.settings
ping localhost -n 1 >nul
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
ping localhost -n 1 >nul
goto booterror

:factoryerror
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Perform system refresh (2 times if neccessary)
Echo. - Perform factory reset
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback.html
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E002 - User performed action without right priviledges
Echo.
Echo The error seems to be caused by the following user: Guest
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E002 - User performed action without right priviledges>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look

:factory2
:surefactory
Echo This action requires a system reboot. System will restart now.
if "%constart%"=="true" set constart=false&call :savesetup&call :wcall&goto restart
set constart=true
call :savesetup
Ping localhost -n 5 >nul
goto restart

:resumereset
if not "%desktop%"=="true" goto setup1
:resumerest
if "%customize%"=="no" set customize=yes

ping localhost -n 1 >nul
color 07
ping localhost -n 1 >nul
color 08
ping localhost -n 1 >nul
cls
ping localhost -n 1 >nul
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%³     
Echo.%blankspace%³     
Echo.%blankspace%³ù    
Echo.%blankspace%³ùù   
Echo.%blankspace%ÀÄÄÄÄÄ
Echo.%blankspace%               
Echo.%tinyspace%Setting up Log OS for the first time use...
ping localhost -n 1 >nul
color 07
ping localhost -n 1 >nul
color 0f
ping localhost -n 1 >nul
ping localhost -n 5 >nul
call :bg_binary_write
set "nope="
goto rests1

:syscheck
::if not exist "%systemroot%\System32\bg.exe" set nope=true
set nope=true
goto :eof
:resumerest1
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
set factory=no
if not "%live%"=="true" @echo. Factory reset unexeptedly stopped!>>log_os\log.txt
if "%desktop%"=="true" goto nologo
:nologo
if "%customize%"=="no" goto rests1
:rests1
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
@echo ::WARNING!>>config_os\%OSname%.settings
@echo ::>>config_os\%OSname%.settings
@echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
@echo ::>>config_os\%OSname%.settings
@echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
::
if "%customize%"=="no" goto rests2
set t=
:rests2
@echo admindescript=%admindescript%,>>config_os\%OSname%.settings
if "%customize%"=="no" goto rests3
:rests3
set restore=logos
if "%customize%"=="no" goto rests4
:rests4
@echo hibernated=false,>>config_os\%OSname%.settings
@echo factory=no,>>config_os\%OSname%.settings
if "%customize%"=="no" goto rests5
:rests5
@echo logoncolor=%logoncolor%,>>config_os\%OSname%.settings

@echo admincol=%admincol%,>>config_os\%OSname%.settings
@echo rndcolor=%usercolor%,>> config_os\%OSname%.settings
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings
if "%customize%"=="no" goto rests6
:rests6
@echo noguest=%noguest%,>>config_os\%OSname%.settings
if "%customize%"=="no" goto rests7
:rests7
set user=%nothing%

if "%customize%"=="no" goto rests8
:rests8
@echo ip=,>> config_os\%OSname%.settings
@echo autoreset=true,>>config_os\%OSname%.settings
if "%customize%"=="no" goto rests9
:rests9
@echo adno=%adno%,>>config_os\%OSname%.settings
@echo adname=%adname%,>>config_os\%OSname%.settings
if "%customize%"=="no" goto rests10
:rests10
@echo classic=%classic%,>>config_os\%OSname%.settings
if "%customize%"=="no" goto rests11
:rests11
@echo autologon=%autologon%,>>config_os\%OSname%.settings
@echo loginname=%loginname%,>>config_os\%OSname%.settings
@echo constart=false,>>config_os\%OSname%.settings
@echo sounded=true,>>config_os\%OSname%.settings
:rests12
@echo nopass=no,>>config_os\%OSname%.settings
@echo noupass=%noupass%,>>config_os\%OSname%.settings
if "%customize%"=="no" goto rests13
:rests13
@echo compat=%compatibility%,>>config_os\%OSname%.settings
@echo constart=%constart%,>>config_os\%OSname%.settings
@echo sounded=%sounded%,>>config_os\%OSname%.settings
@echo oldstart=%oldstart%,>> config_os\%OSname%.settings
if "%gui%"=="yes" set gui=no&goto booterror
if "%customize%"=="no" goto noui
:sdmnskp
set user=%f1%
if "%desktop%"=="true" goto noui
if "%adno%"=="true" goto noui
if "%nopass%"=="yes" goto noui
if not "%adminpass%"=="administratorhasmanyrights" goto noui
:noui
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
reg add HKCU\Console\ /v Fullscreen /t REG_DWORD /d 0 /f >NUL
@echo adminpass=%adminpass%,>>config_os\%OSname%.settings
if "%desktop%"=="true" @echo Shutdown was successful>>log_os\Shutdown&goto startitupagain
@echo Starting fresh>>log_os\freshboot
if exist log_os\Shutdown del log_os\Shutdown
:startitupagain
set desktop=
@echo.>>log_os\terminate
ping localhost -n 1 >nul
if "%customize%"=="no" set "customize="
reg add "HKCU\Software\Microsoft\Command Processor" /v DefaultColor /t REG_DWORD /d 15 /f >nul
start /b "" %0
if exist log_os\lgr del log_os\lgr
exit


:variableerror
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Perform system refresh (2 times if neccessary)
Echo. - Perform factory reset
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback.html
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E003 - Variable not false or true
Echo.
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E003 - Variable not false or true,>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look


:logontype
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Perform system refresh (2 times if neccessary)
Echo. - Perform factory reset
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback.html
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E004 - Logon screen type unknown
Echo.
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E004 - Logon screen type unknown>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look

:sounderror
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Update software from the recovery mode
Echo. - Perform factory reset
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E005 - Sound driver not loaded properly
Echo.
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E005 - Sound driver not loaded properly>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look

:bootloader_error
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Delete logos_bootloader.bat and restart Log OS
Echo. - Perform factory reset
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E006 - Incompatiable bootloader
Echo.
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E006 - Incompatiable bootloader>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look

:forcestop
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Preform system refresh
Echo. - Perform factory reset
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E000 - Manually initiated crash
Echo.
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E000 - Manually initiated crash>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look

:installerror
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Try reinstalling LogOS to your computer
Echo. - Try running installer as an Administrator
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E007 - ANSICON not properly installed
Echo.
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E007 - ANSICON not properly installed>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look

:writeerror
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Check to make sure the disk can write properly
Echo. - Check to make sure you are not using Read-Only optical media
Echo. - Run disk error checker
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E008 - Disk write test failed
Echo.
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E008 - Disk write test failed>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look

:recursion
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Try hard restarting Log OS
Echo. - Update software
Echo. - Try reinstalling Log OS
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E009 - Setlocal maximum recursion occoured
Echo.
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E009 - Setlocal maximum not less or equal>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look

:variablelimit
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Try wiping cache in recovery mode
Echo. - Try hard restarting Log OS
Echo. - Try reinstalling Log OS
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E010 - Variable limit not less or equal
Echo.
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E010 - Variable limit not less or equal>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look

:bootfalse
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Update software
Echo. - Try reinstalling Log OS
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E011 - OS unknown
Echo.
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E011 - OS unknown>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look

:soserror
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Try hard restarting Log OS
Echo. - Try reinstalling Log OS
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E013 - System logger variable unexcepted
Echo.
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E013 - System logger variable unexcepted>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look


:aprilfools
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Try hard restarting Log OS
Echo. - Try reinstalling Log OS
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E014 - System date not set properly
Echo.
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E014 - System logger variable unexcepted>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look

:retrieveor
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Check your internet connection
Echo. - Try retrieving file again later
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E015 - CUST fail
Echo.
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E015 - CUST fail>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look


:updaterr_or
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Try hard restarting Log OS
Echo. - Try reinstalling Log OS
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E016 - System package doesn't contain system info
Echo.
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E016 - System package doesn't contain system info>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look

:systemproblem
color CF
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Try force updating the software
Echo. - Try reinstalling Log OS
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E16R - Log OS system doesn't contain correct system info
Echo.
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E16R - Log OS system doesn't contain correct system info>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look

:writeerrory
color 8F
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Try complete reinstall of Log OS
Echo. - Try reinstalling Log OS
Echo. - Make sure you have media with working I/O (you can test it in the BI/OS setup)
Echo. - Check Log OS for viruses that might prevent the settings file to be written
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E257 - Settings I/O not working properly
Echo.
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E257 - Settings I/O not working properly>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
:lapsyk
goto lapsyk

:recover_or
color CF
cls
Echo.
Echo It looks like Log OS has to shut down to prevent system instability. Try restarting
Echo Log OS. If this screen reappears, do the following:
Echo.
Echo. - Try force updating the software
Echo. - Try reinstalling Log OS
Echo.
Echo If this screen still appears, make sure that the software is up to date and if it is,
Echo please report the problems on:
Echo.
Echo http://logos-technologies.blogspot.com/p/feedback
Echo.
Echo Issues will be fixed as soon as possible.
Echo.
Echo When reporting, make sure you give the following code:
Echo E017 - Incompatible recovery mode
Echo.
Echo.
Echo Dumping session...
if "%autoreset%"=="true" set countdown=true
call :wcall
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\Shutdown del log_os\Shutdown
if exist log_user\This_is_your_desktop del log_user\This_is_your_desktop
if exist log_user\Settings_are_here del log_user\Settings_are_here
@echo.>>log_os\terminate
ping localhost -n 2 >nul
if exist log_os\terminate del log_os\terminate
@echo.E017 - Incompatible recovery mode>>log_os\log.txt
Echo Dump complited
Echo.
Echo Please contact system administrator or developer for further assistance
goto look

:red
color CF
goto :eof

:autosetup
if not "%gui%"=="" goto resumerest1
Ping localhost -n 1 >nul
set adno=false
set noguest=false
set userg=%username%
set loginname=%username%
set autologon=enabled
set nopass=no
set adminpass=administratorhasmanyrights
set usercolor=07
set compat=false
set fullscreen=false
set resolution=six
set factory=no
set hibernated=false
if "%skiplogos%"=="true" set constart=true
set constart=false
if exist log_os\firstuse del log_os\firstuse
if not "%gui%"=="" cls&Echo Finalizing these settings...&set "gui="
goto resumerest1

:firstuse_g
call :passit
if "%OSname%"=="" set "OSname=LogOS"
cls
set "sel=1"
:looper
bin_os\bg.exe locate 0 0
echo.
echo Welcome to %OSname%^^!
echo.
echo Since this is the first time you're booting %OSname%, it is
echo neccesary that you set up any settings for first use. You
echo can do this in 2 ways:
echo.
if "!sel!"=="1" bin_os\bg.exe print f0 " >   Express setup                    \n"
if not "!sel!"=="1" echo.     Express setup                    
if "!sel!"=="2" bin_os\bg.exe print f0 " >   Interactive setup                \n"
if not "!sel!"=="2" echo.     Interactive setup                
echo.
:tryagainsetup
bin_os\bg.exe kbd
set a=%ERRORLEVEL%
if "%a%"=="335" set /a sel+=1
if "%a%"=="327" set /a sel-=1
if "%a%"=="13" goto :ans
if "!sel!"=="0" set sel=1
if "!sel!"=="3" set sel=2
goto looper

:ans
if "%sel%"=="2" goto regularsetup
if "%sel%"=="1" md log_os&@echo.>log_os\Shutdown&goto inin
goto looper

:setup1
goto autosetup
if not "%user%"=="" title Welcome %user% to %OSname% setup
if "%user%"=="" title Welcome to LogOS setup
color 08
ping localhost -n 1 >nul
cls
ping localhost -n 1 >nul
color 07
mode %screen_w%,%screen_h%
if "%automated%"=="true" goto resumerest1
if "%noguest%"=="" set noguest=false
:setup1ui
:regularsetup
Echo Wiping cache...
call :wcall
color 1f
cls
Echo.
Echo Welcome to Log OS interactive setup
Echo.
Echo Please fill in everything. If setting is
Echo left empty, it will use the default setting
Echo on the next reboot.
Echo.
set /p userg=User name:
if "%userg%"=="" goto setadm
set /p pp=User password:
if "%pp%"=="" set noupass=true
set /p userdescription=User description:
set /p usercolor=User color:
:setadm
cls
set /p adn=Enable administrator? (Y/N)
if "%adn%"=="y" set adno=false&set adname=Administrator
if "%adn%"=="Y" set adno=false&set adname=Administrator
if "%adn%"=="N" set adno=true
if "%adn%"=="n" set adno=true
if "%adno%"=="true" goto gog
set /p adminpass=Administrator password:
if "%adminpass%"=="" set nopass=yes
set /p admincol=Administrator color:
set /p admindescript=Administrator description:
:gog
cls
echo.
echo Guest account
echo.
echo Setup all aspects for the guest account
echo.
set /p gdn=Enable guest? (Y/N)
if "%gdn%"=="y" set noguest=false
if "%gdn%"=="Y" set noguest=false
if "%gdn%"=="N" set noguest=true
if "%gdn%"=="n" set noguest=true
if "%noguest%"=="true" goto miscs
set /p guestcolor=Guest color:
:miscs
cls
if "%noguest%"=="true" goto whoopsguest
set /p autolog=Enable autologon for guest? (Y/N)
if "%autolog%"=="Y" set autologon=enabled&set loginname=Guest&goto nextcfg
if "%autolog%"=="y" set autologon=enabled&set loginname=Guest&goto nextcfg
:whoopsguest
if "%userg%"=="" goto whoopsuser
set /p autolog=Enable autologon for %userg%? (Y/N)
if "%autolog%"=="Y" set autologon=enabled&set loginname=%userg%&goto nextcfg
if "%autolog%"=="y" set autologon=enabled&set loginname=%userg%&goto nextcfg
:whoopsuser
if "%adno%"=="true" goto nextcfg
set /p autolog=Enable autologon for %adname%? (Y/N)
if "%autolog%"=="Y" set autologon=enabled&set loginname=%adname%&goto nextcfg
if "%autolog%"=="y" set autologon=enabled&set loginname=%adname%&goto nextcfg
:nextcfg
set /p clas=Enable classic login screen? (Y/N)
if "%clas%"=="y" set classic=true
if "%clas%"=="Y" set classic=true
if "%clas%"=="N" set classic=false
if "%clas%"=="n" set classic=false
set /p snd=Enable startup/shutdown sounds? (Y/N)
if "%snd%"=="Y" set sounded=true
if "%snd%"=="y" set sounded=true
if "%snd%"=="N" set sounded=false
if "%snd%"=="n" set sounded=false
set gui=yes
set "snd="
set "clas="
set "autolog="
set "gdn="
set "adn="
goto resumerest
:safemode
echo Starting in safe mode...
@echo.>>log_os\terminate
if exist bin_os\bg.exe bg font 6
if exist bin_os\bg.exe bg cursor 1
if not "%live%"=="true" @echo. Safe mode closed unexceptedly>>log_os\log.txt
:safemodeui
set reason=Safe_mode
set OSname=LogOS safe mode
title Welcome %nyser% to %OSname%
echo.
Echo Log OS safe mode
echo.
echo To log in, type login and press enter
echo For commands, type ? and press enter.
echo.
goto cmd211

:lotsafe
set "qin="
set "user="
set "pq="
set "adaccess="
echo Logged out
goto setcommand11

:logsafe
set userask=.1
set /p userask=Enter your username:
if "%userask%"=="%userg%" goto loguser
if "%userask%"=="%adname%" goto logadmin
if "%userask%"=="Guest" goto loguest
if "%rerec%"=="true" goto logos
if "%userask%"==".1" goto setcommand11
if %recover% EQU true goto sfrec
if "%conboot%"=="true" goto safemode
if "%fastload%"=="true" goto sfrec
goto setcommand11

:loguser
if "%userg%"=="" echo Logged in as %userg%&goto setcommand11
if "%noupass%"=="true" goto skipasss
if "%pp%"=="" goto skipasss
set /p pass=Enter your password:
if not "%pass%"=="%pp%" echo Logged in as %userg%&goto setcommand11
:skipasss
set pass=
set user=%userg%
set qin=login
color %usercolor%
if "%rerec%"=="true" goto sfrec
echo Logged in as %userg%&goto setcommand11

:logadmin
if "%adno%"=="true" echo Logged in as %adname%&goto setcommand11
if "%nopass%"=="yes" goto skipassss
if "%adminpass%"=="" goto skipassss
set /p pass=Enter your password:
if not "%pass%"=="%adminpass%" echo Logged in as %adname%&goto setcommand11
set pq=%adminpass%
:skipassss
set pass=
set user=%adname%
set qin=login
color %admincol%
set adaccess=true
if "%rerec%"=="true" goto sfrec
echo Logged in as %adname%&goto setcommand11

:loguest
echo To use safe mode as a guest, please log off
goto setcommand11

:compatmode
set compat=yes
set recoveryaccess=no
set slogo=no
echo.>>log_os\Shutdown
goto :eof

:savecompatmode
set compatibility=yes
@echo compatibility=yes,>>config_os\%OSname%.settings
goto setcommand11

:aasfffff
SET userg=
SET n=
SET ip=
SET rndcolor=
SET adminpass=
SET answer5=
SET pw=
SET pp=
SET userdescription=
set hibernated=
set restore=
set usercolor=
set admincol=
set logoncolor=
set guestcolor=
SET factory=
SET noguest=
SET autoreset=
SET adno=
SET an=
SET gn=
SET adname=
SET admindescript=
SET classic=
SET fullscreen=
SET autologon=
SET loginname=
SET domain=
SET domainusername=
SET domaindescription=
SET domainpassword=
SET domaincolor=
SET resolution=
goto setcommand11

:sfcmd
cls
Echo.
Echo CMD prompt is open
Echo.
Echo If you want to go back
Echo type ^"exit^"
Echo.
cmd
goto setcommand11

:about2
Echo Version      : 2.0
Echo Created by   : MarkusMaal
Echo Licenced to  : %username%
Echo Created with : Notepad
goto setcommand11

:sfrec
color 07
ping localhost -n 1 >nul
color 08
ping localhost -n 1 >nul
cls
ping localhost -n 1 >nul
@echo.>>log_os\terminate
if "%adname%"=="UPUPDOWNDOWNLEFTRIGHTLEFTRIGHTBA" goto destroysystem
if exist bin_os\bg.exe bg font 6
if exist bin_os\bg.exe bg cursor 0
if not "%live%"=="true" @echo. Error i0 : Unsafe recovery state>>log_os\log.txt
if "%restart%"=="true" set pw=%adminpass%
if "%user%"=="Guest" set pw=
if "%user%"=="%userg%" set pw=%pp%
if "%user%"=="%adname%" set pw=%adminpass%
set rerec=true
set recover=false
title %OSname% Recovery Mode
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
if exist log_os\LogOS_is_running goto shutdown
:color4f
color 4F
set fastload=false
cls
Echo.
Echo Recovery mode (DFU 1.8.2 MSLOGG1)
Echo.
Echo 1. Wipe cache
Echo 2. Reload cache
Echo 3. Wipe everything / Factory reset
Echo 4. Backup user data
Echo 5. Restore user data
Echo 6. Install system package
if "%attempts%"=="" Echo 7. Refresh system
if "%attempts%"=="1" Echo 7. Refresh system (Basic refresh)
if "%attempts%"=="2" echo 7. Refresh system (Total refresh)
Echo.
Echo Escape = Leave recovery
Echo F1 = Basic help
Echo.
echo CAUTION: Incorrect use of this tool can lead to data loss
if "%live%"=="true" echo Live mode enabled
Echo.
if "%constart%"=="true" goto heyguys
:heyguys
ping localhost -n 1 >nul
bg _kbd
set /a vnum=%vnum%+1
if "%vnum%"=="200" goto blinksaver
set key=%errorlevel%
if "%key%"=="49" set "vnum="&goto wc
if "%key%"=="50" set "vnum="&goto rcache
if "%key%"=="51" set "vnum="&goto wudn
if "%key%"=="52" set "vnum="&goto back2u
if "%key%"=="53" set "vnum="&goto res2u
if "%key%"=="54" set "vnum="&goto flashpackage
if "%key%"=="55" set "vnum="&goto rs
if "%key%"=="27" set "vnum="&del log_os\log.txt&@echo Shutdown was successfull>>log_os\Shutdown&goto exitrecover
if "%key%"=="314" set "vnum="&goto helprec
goto heyguys

:helprec
cls
Echo.
Echo Recovery mode (DFU 1.8.2 MSLOGG1)
Echo.
Echo 1. Wipe cache = Erase temporary data from memory
Echo 2. Reload cache = Reload system data to memory
Echo 3. Wipe everything / Factory reset = Deletes all
Echo                                      system and
echo                                      user data
Echo 4. Backup user data = Backup any system and user
echo                       configuration files. This
echo                       DOES NOT save data in
echo                       home folders.
Echo 5. Restore user data = Loads a backup file and
echo                        restores all
echo                        configuration files.
Echo 6. Install system package = Allows you to install
echo                             new system version.
Echo 7. Refresh system = Attempts to fix errors in
echo                     system configurations. If this
echo                     fails, you can run it two times
echo                     to reset most of configurations
echo                     (doesn't remove user data)
echo.
pause
goto color4f

:blinksaver
cls
color 0F
:blinloop
echo %OSname% %version% recovery mode
ping localhost -n 2 >nul
bg _kbd
set key=%errorlevel%
if not "%key%"=="0" set "vnum="&goto color4f
cls
ping localhost -n 2 >nul
bg _kbd
set key=%errorlevel%
if not "%key%"=="0" set "vnum="&goto color4f
goto blinloop

:rcache
if "%live%"=="true" goto sfrec
if exist bin_os\bg.exe bg cursor 1
if "%adno%"=="true" goto rcachenow
if "%nopass%"=="yes" goto rcachenow
if "%pq%" == "%adminpass%" goto rcachenow
cls
Echo.
Echo  To continue please enter last used administrator account's&echo. password
Echo.
set/ppq=Password:
if "%pq%"=="%adminpass%" goto rcachenow
ansicon -m4C -e Error i6 : Incorrect password
Pause
goto sfrec

:rcachenow
cls
Echo Checking for cache file...
if not exist config_os\%OSname%.settings goto restorerrornv
Echo Restoring
for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
Echo Cache restored
Pause
goto sfrec

:restorerrornv
Echo Error 404: Cache file not found
pause
goto sfrec

:flashpackage
if "%live%"=="true" goto sfrec
if exist bin_os\bg.exe bg cursor 1
if "%adno%"=="true" goto flashscreen
if "%nopass%"=="yes" goto flashscreen
if "%pq%" == "%adminpass%" goto flashscreen
cls
Echo.
Echo  To continue please enter last used administrator account's&echo. password
Echo.
set/ppq=Password:
if "%pq%"=="%adminpass%" goto flashscreen
ansicon -m4C -e Error i6 : Incorrect password
Pause
goto sfrec

:flashscreen
cls
Echo.
Echo Install system package
Echo.
Echo Please enter the system package folder location:
set /p destination=
if not exist "%destination%" goto errorscfl
goto systemupdate_g

:enterbios
if exist bin_os\bg.exe bg cursor 1
if "%adno%"=="true" goto bbchaos
if "%nopass%"=="yes" goto bbchaos
if "%pq%" == "%adminpass%" goto bbchaos
cls
Echo.
Echo  To continue please enter last used administrator account's&echo. password
Echo.
set/ppq=Password:
if "%pq%"=="%adminpass%" goto bbchaos
ansicon -m4C -e Error i6 : Incorrect password
Pause
goto sfrec

:bbchaos
cls
Echo Setting BIOS key...
set setup=true
Echo.
Echo In order to enter BIOS setup, you need to
Echo restart Log OS machine.
Echo.
Echo Press any key to continue with restart...
Pause >nul
call :wcall
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
start /b "" %0
exit
:sysupdt
if "%live%"=="true" goto sfrec
if exist bin_os\bg.exe bg cursor 1
if "%adno%"=="true" goto systemupdate
if "%nopass%"=="yes" goto systemupdate
if "%pq%" == "%adminpass%" goto systemupdate
cls
Echo.
Echo  To continue please enter last used administrator account's&echo. password
Echo.
set/ppq=Password:
if "%pq%"=="%adminpass%" goto systemupdate
ansicon -m4C -e Error i6 : Incorrect password
Pause
goto sfrec

:setupboot
if not exist succeed_key goto delkey
del succeed_key
set setup=true
call :wcall
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
@echo Starting>>startsetup
start /b "" %0
exit

:systemupdate
if exist bin_os\bg.exe bg cursor 0
cls
Echo.
Echo Are you sure?
Echo.
Echo This CANNOT BE UNDONE!
Echo.
Echo 1. Yes
Echo 2. No
Echo 3. Leave recovery
Echo.
bg kbd
set key=%errorlevel%
if %key%==49 goto systemupdate1
if %key%==50 goto sfrec
if %key%==51 del log_os\log.txt&@echo Shutdown was successfull>>log_os\Shutdown&goto exitrecover

goto systemupdate

:rs
if "%live%"=="true" goto sfrec
if exist bin_os\bg.exe bg cursor 1
if "%adno%"=="true" goto rsui
if "%nopass%"=="yes" goto rsui
if "%pq%" == "%adminpass%" goto rsui
cls
Echo.
Echo  To continue please enter last used administrator account's&echo. password
Echo.
set/ppq=Password:
if "%pq%"=="%adminpass%" goto rsui
ansicon -m4C -e Error i6 : Incorrect password
Pause
goto sfrec

:rsui
if exist bin_os\bg.exe bg cursor 0
if exist bin_os\bg.exe bg cursor 0
cls
Echo.
Echo Refreshing system
Echo.
Echo This will check for empty saving
Echo blocks and fixes them if neccessary.
Echo Useful if you are having trouble with
Echo some startup errors.
Echo.
Echo This won't wipe any user made settings,
Echo but error you might have occoured,
Echo might has deleted your user data.
Echo.
ansicon -m4C -e DO NOT TURN OFF LOG OS DURING THE PROCESS!!!
if "%attempts%"=="" echo As of it is first attempt, we'll
if "%attempts%"=="" echo not perform full system refresh.
if "%attempts%"=="1" echo As this is second attempt, we'll
if "%attempts%"=="1" echo now do a full system refresh. If
if "%attempts%"=="1" echo you'd like to do normal refresh,
if "%attempts%"=="1" echo just wipe cache and try again.
Pause
if "%attempts%"=="1" goto totalrefresh
if "%attempts%"=="" goto normalrefresh
goto normalrefresh
:normalrefresh
set rreason=%reason%
Echo Loading user data
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if not exist config_os\%OSname%.settings Echo Settings not found, skipping...
Echo Deleting previous settings
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
:finishfx
set att=0
:village
if "%att%"=="2" goto fup
echo ::WARNING!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
::

@echo ip=%ip%,>> config_os\%OSname%.settings
if "%finishflash%"=="true" title 95%% ^|
if "%rndcolor%"=="" Echo. Replacing broken main color (rndcolor)
if "%rndcolor%"=="" set rndcolor=07
@echo rndcolor=%rndcolor%,>> config_os\%OSname%.settings
if "%adminpass%"=="" Echo. Replacing broken administrator password (adminpass)
if "%adminpass%"=="" set adminpass=administratorhasmanyrights
@echo adminpass=%adminpass%,>> config_os\%OSname%.settings
if "%answer5%"=="" Echo. Replacing broken wrong password answer (answer5)
@echo answer5=%answer5%,>> config_os\%OSname%.settings


if "%hibernated%"=="" Echo. Replacing broken startup setting (hibernated)
if "%hibernated%"=="" set hibernated=false
@echo hibernated=%hibernated%,>>config_os\%OSname%.settings
if "%hibernated%"=="true" goto checkhiberstuff
:resumerestore
@echo restore=%restore%,>>config_os\%OSname%.settings
if "%usercolor%"=="" Echo. Replacing broken user theme setting (usercolor)
if "%usercolor%"=="" set usercolor=07

if "%admincol%"=="" Echo. Replacing broken administrator color (admincol)
if "%admincol%"=="" set admincol=07
@echo admincol=%admincol%,>>config_os\%OSname%.settings
if "%logoncolor%"=="" Echo. Replacing broken login screen color (logoncolor)
if "%logoncolor%"=="" set logoncolor=07
if "%finishflash%"=="true" title 96%% /
@echo logoncolor=%logoncolor%,>>config_os\%OSname%.settings
if "%guestcolor%"=="" Echo. Replacing broken guest theme color (guestcolor)
if "%guestcolor%"=="" set guestcolor=07
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings
if "%factory%"=="" Echo. Replacing broken out of box experience setting (factory)
if "%factory%"=="" set factory=no
@echo factory=no,>> config_os\%OSname%.settings
if "%noguest%"=="" Echo. Replacing broken guest setting (noguest)
if "%noguest%"=="" set noguest=false
@echo noguest=%noguest%,>> config_os\%OSname%.settings
if "%autoreset%"=="" Echo. Replacing broken automatic restart setting (autoreset)
if "%autoreset%"=="" set autoreset=true
@echo autoreset=%autoreset%,>>config_os\%OSname%.settings
if "%adno%"=="" Echo. Replacing broken administrator status (adno)
if "%adno%"=="" set adno=false
if "%adno%"=="true" call :checkforlogonissue
:continuerefr
@echo adno=%adno%,>>config_os\%OSname%.settings
if "%adname%"=="" Echo. Replacing broken administrator name (adname)
if "%adname%"=="" set adname=Administrator
@echo adname=%adname%,>>config_os\%OSname%.settings
@echo admindescript=%admindescript%,>>config_os\%OSname%.settings
if "%finishflash%"=="true" title 97%% --
if "%classic%"=="" Echo. Replacing broken classic logon setting (classic)
if "%classic%"=="" set classic=false
@echo classic=%classic%,>>config_os\%OSname%.settings
if "%autologon%"=="" Echo. Replacing broken autologon setting (autologon)
if "%autologon%"=="" set autologon=false
@echo autologon=%autologon%,>>config_os\%OSname%.settings
@echo loginname=%loginname%,>>config_os\%OSname%.settings
if "%finishflash%"=="true" title 98%% \
if "%nopass%"=="" Echo. Replacing broken administrator no password setting (nopass)
if "%noupass%"=="" Echo. Replacing broken user no password setting (noupass)
if "%nopass%"=="" set nopass=no
if "%noupass%"=="" set noupass=false
@echo nopass=%nopass%,>>config_os\%OSname%.settings
@echo noupass=%noupass%,>>config_os\%OSname%.settings
if "%finishflash%"=="true" title 99%% ^|
if "%compatibility%"=="" Echo.Replacing broken compatibility setting (compat)
if "%compatibility%"=="" @echo compatibility=%compatibility%,>>config_os\%OSname%.settings

if "%resolution%"=="" Echo. Replacing broken screen text setting (resolution)
if "%resolution%"=="seven" Echo Replacing broken screen text setting (resolution)
if "%resolution%"=="seven" set resolution=six&@echo resolution=six,>>config_os\%OSname%.settings
if "%resolution%"=="" set resolution=six&@echo resolution=six,>>config_os\%OSname%.settings
if "%constart%"=="" Echo. Replacing broken verbose variable (constart)
if "%constart%"=="" set constart=false
if "%skiplogos%"=="true" set constart=true
if "%sounded%"=="" set sounded=true&Echo. Replacing broken sound variable (sounded)
@echo sounded=%sounded%,>>config_os\%OSname%.settings
@echo constart=%constart%,>>config_os\%OSname%.settings
@echo oldstart=%oldstart%,>> config_os\%OSname%.settings
set /a att=%att%+1
goto village
:fup
if "%finishflash%"=="true" goto firstart
Echo. Check and save completed
Echo. If you didn't see much text, your system was
Echo. alright. But if you did see a lot of text, 
Echo. that means that your system was really 
Echo. broken.
Echo Restoring recovery reason
set reason=%rreason%
set rreason=
Echo Checking saved data...
if exist config_os\%OSname%.settings Echo. Check was successfull
if not exist config_os\%OSname%.settings ansicon -m4C -e Echo. Error: File doesn't exist
Echo Setting attempt data...
set attempts=1
Echo Done^!
Pause
goto sfrec

:totalrefresh
Echo Performing forced system refresh (use if normal
Echo refresh doesn't fix anything)
Echo.
Echo Saving current reason to the variable
set rreason=%reason%
Echo Deleting attempts data
set attempts=
Echo Loading user data
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if not exist config_os\%OSname%.settings Echo Settings not found, skipping...
Echo Deleting previous settings
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
Echo Replacing SYSTEM settings with defaults
set att=0
echo ::WARNING!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
::

@echo ip=Wrong password:>> config_os\%OSname%.settings
@echo rndcolor=07,>> config_os\%OSname%.settings
@echo adminpass=administratorhasmanyrights,>> config_os\%OSname%.settings


@echo hibernated=false,>> config_os\%OSname%.settings
set t=
@echo admincol=%admincol%,>>config_os\%OSname%.settings
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings

@echo factory=false,>>config_os\%OSname%.settings
set t=

@echo admincol=%admincol%,>>config_os\%OSname%.settings
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings
@echo noguest=false,>> config_os\%OSname%.settings
@echo logoncolor=07,>> config_os\%OSname%.settings
@echo autoreset=false,>>config_os\%OSname%.settings
@echo adname=Administrator,>>config_os\%OSname%.settings
@echo adno=false,>>config_os\%OSname%.settings
@echo noguest=false,>>config_os\%OSname%.settings
@echo admindescript=,>>config_os\%OSname%.settings
@echo classic=false,>>config_os\%OSname%.settings
@echo autologon=disabled,>>config_os\%OSname%.settings
@echo loginname=,>>config_os\%OSname%.settings
@echo nopass=no,>>config_os\%OSname%.settings
@echo noupass=%noupass%,>>config_os\%OSname%.settings
@echo compatibility=false,>>config_os\%OSname%.settings
@echo resolution=six,>>config_os\%OSname%.settings
@echo constart=false,>>config_os\%OSname%.settings
@echo oldstart=%oldstart%,>> config_os\%OSname%.settings
@echo sounded=%sounded%,>>config_os\%OSname%.settings
Echo. Reloading settings...
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
Echo. Refresh has been complited
Echo. Your system now should work fine. If it doesn't
Echo. try using Wipe User Data and Factory default
Echo. options. All related to Administrator and Guest
Echo. (except colors) is overwritten with default
Echo. settings. Custom user account is untouched.
Echo Restoring recovery reason
set reason=%rreason%
set rreason=
Echo Checking saved data...
if exist config_os\%OSname%.settings Echo. Check was successfull
if not exist config_os\%OSname%.settings ansicon -m4C -e Error: File doesn't exist
Echo Done^!
Pause
goto sfrec

:destroysystem
::This bit of code was removed for security reasons
:sagloog
goto sagloog

:checkforlogonissue
if "%adname%"=="" goto :eof
if not "%reason%"=="" Echo. Replacing broken autologon script for
if not "%reason%"=="" Echo. %adname%
set adno=false
goto :eof

:checkhiberstuff
goto resumerestore

:error2015
cls
Echo.
Echo.
Echo No files to flash.
Echo.
Echo.
Pause
goto systemupdate

:error111112015
cls
Echo.
Echo.
Echo Version you specified is al-
Echo ready installed.
Echo.
Echo.
Pause
goto logos

:error40402015
cls
Echo.
Echo.
Echo Destination is incorrect
Echo.
Echo.
Pause
goto logos

:error40202015
cls
Echo. Flashing was unsuccessful.
Echo.
Echo.  Reventing changes...
copy "%cd%\Backup\LogOS.bat" "%cd%"
call :wcall
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
start /b "" %0
if exist log_os\lgr del log_os\lgr
exit

:exitrecover
@echo recover=false,>>config_os\%OSname%.settings
@echo reason=,>>config_os\%OSname%.settings
if "%reason%"=="Your OS doesn't support fullscreen mode" goto sfrec
if "%restart%"=="true" set restart=false
if "%restart%"=="false" title Welcome %user% to %OSname%
cls
if "%rndcolor%"=="" set rndcolor=07
color %rndcolor%
start /b "" %0
exit

:res2u
if "%live%"=="true" goto sfrec
if exist bin_os\bg.exe bg cursor 1
if "%adno%"=="true" goto res2v
if "%nopass%"=="yes" goto res2v
if "%pq%" == "%adminpass%" goto res2v
cls
Echo.
Echo  To continue please enter last used administrator account's&echo. password
Echo.
set/ppq=Password:
if "%pq%"=="%adminpass%" goto res2v
ansicon -m4C -e Error i6 : Incorrect password
Pause
goto sfrec
:res2v
if exist bin_os\bg.exe bg cursor 0
cls
Echo.
Echo Are you sure?
Echo.
Echo This CANNOT BE UNDONE!
Echo.
Echo 1. Yes
Echo 2. No
Echo 3. Leave recovery
Echo.
bg kbd
set key=%errorlevel%
if %key%==49 goto res2u2
if %key%==50 goto sfrec
if %key%==51 del log_os\log.txt&@echo Shutdown was successfull>>log_os\Shutdown&goto exitrecover

goto res2v

:res2u2
if exist bin_os\bg.exe bg cursor 1
set /p answer=Enter backup name (without cmd):
if not exist backups md backups
if exist bin_os\bg.exe bg cursor 0
set load=%answer%.cmd
Echo Loading backup file...
if not exist backups\%load% goto res2u2e
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
set /a idint=1
set "usr="
for /f "eol=: delims=," %%a in (backups\%load%) do (
set "temp=%%a"
if "!idint!"=="1" (
if not "!temp:~0,1!"=="_" (
	set !temp!
) else (
	set /a idint+=1
	set usr=!temp:~1!
	echo Deleting existing user configurations...
	rd config_user /s /q
	md config_user
	echo Restoring user configurations...
	echo  Restoring !usr!'s configurations...
	@echo.::WARNING>config_user\!usr!.settings
	@echo.::>>config_user\!usr!.settings
	@echo.::To avoid errors in Log OS, please don't edit this file>>config_user\!usr!.settings
	@echo.::>>config_user\!usr!.settings
	@echo.::Restored at : %date% %time%>>config_user\!usr!.settings
)
) else (
if not "!temp:~0,1!"=="_" (
	@echo.!temp!,>>config_user\!usr!.settings
) else (
	set /a idint+=1
	set usr=!temp:~1!
	echo  Restoring !usr!'s configurations...
	@echo.::WARNING>config_user\!usr!.settings
	@echo.::>>config_user\!usr!.settings
	@echo.::To avoid errors in Log OS, please don't edit this file>>config_user\!usr!.settings
	@echo.::>>config_user\!usr!.settings
	@echo.::Restored at : %date% %time%>>config_user\!usr!.settings
)
)
)
Echo Deleting previous system configuration file...
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
Echo Restoring system configuration...
if "%live%"=="yes" goto res2u2er2
echo ::WARNING!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
::

@echo ip=%ip%,>> config_os\%OSname%.settings
@echo rndcolor=%rndcolor%,>> config_os\%OSname%.settings
@echo adminpass=%adminpass%,>> config_os\%OSname%.settings



@echo hibernated=%hibernated%,>>config_os\%OSname%.settings
@echo restore=%restore%,>>config_os\%OSname%.settings
@echo t=%t%,>>config_os\%OSname%.settings

@echo admincol=%admincol%,>>config_os\%OSname%.settings
@echo logoncolor=%logoncolor%,>>config_os\%OSname%.settings
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings
@echo factory=no,>> config_os\%OSname%.settings
@echo noguest=%noguest%,>> config_os\%OSname%.settings
@echo autoreset=%autoreset%,>>config_os\%OSname%.settings
@echo adno=%adno%,>>config_os\%OSname%.settings
@echo adname=%adname%,>>config_os\%OSname%.settings
@echo admindescript=%admindescript%,>>config_os\%OSname%.settings
@echo classic=%classic%,>>config_os\%OSname%.settings
@echo autologon=%autologon%,>>config_os\%OSname%.settings
@echo loginname=%loginname%,>>config_os\%OSname%.settings
@echo nopass=%nopass%,>>config_os\%OSname%.settings
@echo noupass=%noupass%,>>config_os\%OSname%.settings
@echo compatibility=%compatibility%,>>config_os\%OSname%.settings
::@echo resolution=%resolution%,>>config_os\%OSname%.settings
@echo constart=%constart%,>>config_os\%OSname%.settings
@echo sounded=%sounded%,>>config_os\%OSname%.settings
@echo oldstart=%oldstart%,>> config_os\%OSname%.settings
Echo Checking file save...
if not exist config_os\%OSname%.settings goto res2i2e
Echo Okay
Echo Done!
Pause
goto sfrec

:res2u2e
ansicon -m4C -e Error i1 : No backup file (backups\%load%) found
Pause
goto sfrec

:res2u2er2
ansicon -m4C -e Error i2 : You have no permission to overwrite system files
Pause
goto sfrec

:res2i2e
ansicon -m4C -e Error i2 : Saved file (config_os\%OSname%.settings) doesn't exist
Pause
goto sfrec

:back2u
if "%live%"=="true" goto sfrec
if exist bin_os\bg.exe bg cursor 1
if "%adno%"=="true" goto bak2name
if "%nopass%"=="yes" goto bak2name
if "%pq%" == "%adminpass%" goto bak2name
cls
Echo.
Echo  To continue please enter last used administrator account's&echo. password
Echo.
set/ppq=Password:
if "%pq%"=="%adminpass%" goto bak2name
ansicon -m4C -e Error i6 : Incorrect password
Pause
goto sfrec
:bak2name
if exist bin_os\bg.exe bg cursor 1
set /p answer=Enter new backup name (no .cmd or spaces):
if exist bin_os\bg.exe bg cursor 0
if not exist backups md backups
set backup=%answer%.cmd
if exist backups\%backup% goto back2c
:back2d
Echo Backing up...
Echo. Save date
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\LogOS.settings) do set %%a
echo ::WARNING!>>backups\%backup%
echo ::>>backups\%backup%
echo ::To avoid errors in Log OS, please don't edit this file>>backups\%backup%
echo ::Saved at : N 18.09.2014 17:51:51.01>>backups\%backup%
Echo.  Date saved successfully
Echo. Backing up userdata...
Echo. Safe mode name
@echo userg=%userg%,>>backups\%backup%
Echo. Incorrect password message
@echo ip=%ip%,>>backups\%backup%
Echo. Safe mode's color
@echo rndcolor=%rndcolor%,>>backups\%backup%
Echo. Administrator's password
@echo adminpass=%adminpass%,>>backups\%backup%
Echo. User password
@echo pp=%pp%,>>backups\%backup%
Echo. User description
@echo userdescription=%userdescription%,>>backups\%backup%
Echo. Hibernate state
@echo hibernated=%hibernated%,>>backups\%backup%
@echo restore=%restore%,>>backups\%backup%
Echo. Colors
@echo usercolor=%usercolor%,>>backups\%backup%
@echo admincol=%admincol%,>>backups\%backup%
@echo logoncolor=%logoncolor%,>>backups\%backup%
@echo guestcolor=%guestcolor%,>>backups\%backup%
Echo. Factory reset settings
@echo factory=%factory%,>>backups\%backup%
Echo. Settings : Disable guest?
@echo noguest=%noguest%,>>backups\%backup%
Echo. Settings : Restart on errors
@echo autoreset=%autoreset%,>>backups\%backup%
Echo. Settings : Disable administrator?
@echo adno=%adno%,>>backups\%backup%
Echo. Administrator's name
@echo adname=%adname%,>>backups\%backup%
Echo. Administrator's description
@echo admindescript=%admindescript%,>>backups\%backup%
Echo. Logon type
@echo classic=%classic%,>>backups\%backup%
Echo. Autologon
@echo autologon=%autologon%,>>backups\%backup%
Echo. Autologon name
@echo loginname=%loginname%,>>backups\%backup%
Echo. Nopass settings
@echo nopass=%nopass%,>>backups\%backup%
@echo noupass=%noupass%,>>backups\%backup%
Echo. Compatibility
@echo compatibility=%compatibility%,>>backups\%backup%
Echo. Domain
@echo domain=%domain%,>>backups\%backup%
Echo. Resolution
@echo resolution=%resolution%,>>backups\%backup%
Echo. Console start variable
@echo constart=%constart%,>>backups\%backup%
@echo sounded=%sounded%,>>backups\%backup%
Echo System data was backuped
echo *
echo Backing up user profiles...
for /f "delims=" %%a in ('dir /b config_user') do (
	set temp=%%a
	set "u=!temp:.settings=!"
	@echo._!u!>>backups\%backup%
	echo. User: !temp:.settings=!
	for /f "eol=: delims=" %%b in (config_user\%%a) do (
		@echo.%%b>>backups\%backup%
	)
)
Echo Checking is file correctly writen...
if not exist backups\%backup% goto back2ue
Echo Checked successfully
Echo Done!
Pause
goto sfrec

:back2c
bg cursor 1
set /p answer=File already exists. Overwrite? (Y/N)
cls
if %answer%==y del backups\%backup%&goto back2d
if %answer%==n del backups\%backup%&goto back2uc
if %answer%==Y del backups\%backup%&goto back2d
if %answer%==N del backups\%backup%&goto back2uc
goto back2c

:back2ue
ansicon -m4C -e Error i2 : Saved file (backups\%backup%) doesn't exist!
Pause
goto sfrec

:back2uc
ansicon -m4C -e Error i3 : Cannot save without overwrite!
Pause
goto sfrec

:wc
if exist bin_os\bg.exe bg cursor 1
if "%adno%"=="true" goto wcmain
if "%nopass%"=="yes" goto wcmain
if "%pq%" == "%adminpass%" goto wcmain
cls
Echo.
Echo  To continue please enter last used administrator account's&echo. password
Echo.
set/ppq=Password:
if "%pq%"=="%adminpass%" goto wcmain
ansicon -m4C -e Error i6 : Incorrect password
Pause
goto sfrec
:wcmain
if exist bin_os\bg.exe bg cursor 0
cls
Echo.
Echo Are you sure?
Echo.
Echo This CANNOT BE UNDONE!
Echo.
Echo 1. Yes
Echo 2. No
Echo 3. Leave recovery
Echo.
bg kbd

if %key%==49 goto wc2
if %key%==50 goto sfrec
if %key%==51 del log_os\log.txt&@echo Shutdown was successfull>>log_os\Shutdown&goto exitrecover

goto wc

:wc2
if exist bin_os\bg.exe bg cursor 0
Echo Wiping cache...
if exist backupenv.bat del backupenv.bat
if exist logos del logos
if exist logossettings.cmd del logossettings.cmd
Echo Unloading variables...
SET userg=
SET n=
SET ip=
SET rndcolor=
SET adminpass=
SET answer5=
SET pw=
SET pp=
SET userdescription=
set hibernated=
set restore=
set usercolor=
set admincol=
set logoncolor=
set guestcolor=
SET factory=
SET noguest=
SET autoreset=
SET adno=
SET an=
SET gn=
SET adname=
SET admindescript=
SET classic=
SET fullscreen=
SET autologon=
SET loginname=
SET nopass=
SET noupass=
SET userg=
SET ip=
SET rndcolor=
SET adminpass=
SET pp=
SET userdescription=
set hibernated=
set restore=
set restore=
SET restoreloader=
set t=
set usercolor=
set admincol=
set logoncolor=
set guestcolor=
SET factory=
SET noguest=
SET autoreset=
SET adno=
SET adname=
SET admindescript=
SET classic=
SET autologon=
SET loginname=
SET nopass=
SET noupass=
SET compatibility=
SET resolution=
SET sos=
SET nos=
SET restart=
SET n=
SET compat1=
SET constart=
SET sounded=
SET sel=
SET returncmd=
SET hour=
SET min=
SET secs=
SET user=
SET password=
SET description=
SET randomm=
SET pass=
SET pq=
SET reason=
SET domain=
SET domainusername=
SET domainpassword=
SET domaindescription=
SET description=
SET user=
SET password=
SET domaincolor=
SET resolution=
SET restart=
set attempts=
call :wcall
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
Echo Done!
Pause
goto sfrec

:wud
if "%live%"=="true" goto sfrec
if "%adno%"=="true" goto factorymenu
if "%nopass%"=="true" goto factorymenu
if "%pq%" == "%adminpass%" goto factorymenu
cls
Echo.
Echo  To continue please enter last used administrator account's&echo. password
Echo.
set/ppq=Password:
if "%pq%"=="%adminpass%" goto factorymenu
ansicon -m4C -e Error i6 : Incorrect password
Pause
goto sfrec
:factorymenu
if exist bin_os\bg.exe bg cursor 0
cls
Echo.
Echo Are you sure?
Echo.
Echo This CANNOT BE UNDONE!
Echo.
Echo 1. Yes
Echo 2. No
Echo 3. Leave recovery
Echo.
bg kbd
if %key%==49 goto wud2
if %key%==50 goto sfrec
if %key%==51 del log_os\log.txt&@echo Shutdown was successfull>>log_os\Shutdown&goto exitrecover

goto wud

:wudn
if "%live%"=="true" goto sfrec
if "%adno%"=="true" goto wudmenu
if "%nopass%"=="true" goto wudmenu
if "%pq%" == "%adminpass%" goto wudmenu
cls
Echo.
Echo  To continue please enter last used administrator account's&echo. password
Echo.
set/ppq=Password:
if "%pq%"=="%adminpass%" goto wudmenu
ansicon -m4C -e Error i6 : Incorrect password
Pause
goto sfrec
:wudmenu
if exist bin_os\bg.exe bg cursor 0
cls
Echo.
Echo Are you sure?
Echo.
Echo This CANNOT BE UNDONE!
Echo.
Echo 1. Yes
Echo 2. No
Echo 3. Leave recovery
Echo.
bg kbd
set key=%errorlevel%
if %key%==51 del log_os\log.txt&@echo Shutdown was successfull>>log_os\Shutdown&goto exitrecover
if %key%==50 goto sfrec
if %key%==49 goto wud4

goto wudmenu

:wud4
if exist bin_os\bg.exe bg cursor 0
cls
Echo Preparing...
Echo. Wiping cache
if exist logos del logos
if exist log_os\Shutdown del log_os\Shutdown
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
del boot_os\logos_logo.bat
Echo. Deleting userdata...
rd config_user /s /q
rd config_os /s /q
rd specific_user /s /q
rd log_user /s /q
rd log_os /s /q
rd temp_os /s /q
del config_os\%OSname%.settings
Echo. Injecting sound driver...
@echo.::Ends sound driver>>log_os\terminate
ping localhost -n 1 >nul
if exist boot_os\Sound.bat del boot_os\Sound.bat
Echo. Injecting bootloader...
set fbootloader=
SET bootloader=
Echo. Injecting recovery mode
set recover=
set reason=
ping localhost -n 1 >nul
color 0F
set passwd=
title Welcome to %OSname% %user%
ping localhost -n 1 >nul
Echo. Unloading variables...
SET userg=
SET n=
set OSname=
SET ip=
SET rndcolor=
SET adminpass=
SET answer5=
SET pw=
SET pp=
SET userdescription=
set hibernated=
set restore=
set usercolor=
set admincol=
set logoncolor=
set guestcolor=
SET factory=
SET noguest=
SET autoreset=
SET adno=
SET an=
SET gn=
SET adname=
SET admindescript=
SET classic=
SET fullscreen=
SET autologon=
SET loginname=
SET nopass=
SET noupass=
SET domain=
SET domainusername=
SET domainpassword=
SET domaindescription=
SET description=
SET user=
SET password=
SET domaincolor=
SET resolution=
set factory=
call :wcall
set "recover="
Echo Finishing up...
set reason=
Echo. To finish user data removal, OS will unpack
Echo. its factory data and restart several times.
Echo. Please do not cancel the process. This can 
Echo. lead to data corruption.
Echo Press any key to restart Log OS...
Pause>nul
cls
if exist log_os\log.txt del log_os\log.txt
del logos
start /b "" %0
if exist log_os\lgr del log_os\lgr
exit

:wud2
cls
Echo.
Echo. Factory defaults
Echo.
Echo This option is used to create live bootable
Echo LogOS for Read-Only CD.
Echo.
Echo The default administrator password is
Echo administratorhasmanyrights
Echo.
Echo Press any key to start...
bg cursor 0
pause>nul
cls
Echo. Preparing...
Echo. Wiping cache
if exist logos del logos
if exist log_os\Shutdown del log_os\Shutdown
del boot_os\logos_logo.bat
Echo. Deleting userdata...
del config_os\%OSname%.settings
Echo. Unloading variables...
SET userg=
SET n=
SET ip=
SET rndcolor=
SET adminpass=
SET answer5=
SET pw=
SET pp=
SET userdescription=
set hibernated=
set restore=
set usercolor=
set admincol=
set logoncolor=
set guestcolor=
SET factory=
SET noguest=
SET autoreset=
SET adno=
SET an=
SET gn=
SET adname=
SET admindescript=
SET classic=
SET fullscreen=
SET autologon=
SET loginname=
SET nopass=
SET noupass=
SET domain=
SET domainusername=
SET domainpassword=
SET domaindescription=
SET description=
SET user=
SET password=
SET domaincolor=
SET resolution=
Echo. To finish reset, you need to boot factory 
Echo. image (log_os\firstuse) System will create it
Echo. automatically.
Echo Press any key to restart with factory image
Pause>nul
cls
if exist log_os\log.txt del log_os\log.txt
start /b "" %0
if exist log_os\lgr del log_os\lgr
exit

:setuperror
color 4f
cls
echo.
echo ***
echo Operating system binaries were not found. Please reinstall Log OS with the proper binaries.
echo Setup has been halted.
:serrloop
goto serrloop

:wud3
if exist bin_os\bg.exe bg cursor 0
md config_os
if exist logos del logos
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
::if exist bin_os\bg.exe del bg.exe
if not exist bin_os\bg.exe call :bg_binary_write
md config_user
@echo.::WARNING^^!>config_os\Screen.settings
@echo.::>>config_os\Screen.settings
@echo.::To avoid errors in Log OS, please don't edit this file>>config_os\Screen.settings
@echo.::>>config_os\Screen.settings
@echo.::Created at: %date% %time%>>config_os\Screen.settings
if "%screen_w%"=="" set screen_w=150
@echo.screen_w=%screen_w%,>>config_os\Screen.settings
if "%screen_h%"=="" set screen_h=45
@echo.screen_h=%screen_h%,>>config_os\Screen.settings
echo ::WARNING!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::Saved at : N 18.09.2014 17:51:51.01>>config_os\%OSname%.settings
::
@echo factory=yes,>>config_os\%OSname%.settings
@echo hibernated=false,>>config_os\%OSname%.settings
@echo resolution=six,>>config_os\%OSname%.settings
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if exist log_os\log.txt del log_os\log.txt
if exist log_os\log.txt goto writeerror
@echo Startinglog_os\firstuse>>log_os\firstuse
@echo Shutdown was successfull>>log_os\Shutdown
if not exist config_os\%OSname%.settings goto writeerrory
ping localhost -n 2 >nul
bg _kbd
set key=%ERRORLEVEL%
if "%key%"=="115" Echo Please wait...&goto setup1ui
if "%key%"=="83" Echo Please wait...&goto setup1ui
ping localhost -n 1 >nul
color 07
ping localhost -n 1 >nul
color 08
ping localhost -n 1 >nul
cls
ping localhost -n 1 >nul
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%               
Echo.%blankspace%³     
Echo.%blankspace%³     
Echo.%blankspace%³ù    
Echo.%blankspace%³ùù   
Echo.%blankspace%ÀÄÄÄÄÄ
Echo.%blankspace%               
Echo.%tinyspace%Setting up Log OS for the first time use...
ping localhost -n 1 >nul
color 07
ping localhost -n 1 >nul
color 0f
ping localhost -n 1 >nul
goto logos
:wsm
if "%live%"=="true" goto sfrec
if exist bin_os\bg.exe bg cursor 1
if "%adno%"=="true" goto wsmui
if "%nopass%"=="yes" goto wsmui
if "%pq%" == "%adminpass%" goto wsmui
cls
Echo.
Echo  To continue please enter last used administrator account's&echo. password
Echo.
set/ppq=Password:
if "%pq%"=="%adminpass%" goto wsmui
ansicon -m4C -e Error i6 : Incorrect password
Pause
goto sfrec
:wsmui
if exist bin_os\bg.exe bg cursor 0
cls
Echo.
Echo Are you sure?
Echo.
Echo This CANNOT BE UNDONE!
Echo.
Echo 1. Yes
Echo 2. No
Echo 3. Leave recovery
Echo.
bg kbd

if %key%==49 goto wsm2
if %key%==50 goto sfrec
if %key%==51 del log_os\log.txt&@echo Shutdown was successfull>>log_os\Shutdown&goto exitrecover

goto wsm

:wsm2
if exist bin_os\bg.exe bg cursor 0
cls
Echo. Wiping safe mode
@echo rndcolor=07,>>config_os\%OSname%.settings
@echo nyser=%username%,>>config_os\%OSname%.settings
Echo. Applying changes
set rndcolor=07
set nyser=%username%
color %rndcolor%
Echo. Done!
Pause
goto sfrec

:settingssafe
Echo.
Echo Settings (Safe mode)
Echo.
Echo 1. Name : %nyser%
Echo 2. Color : %rndcolor%
Echo 3. Back to start
Echo.
set /p answer=Your selection=
if "%answer%"=="1" goto chgnyser
if "%answer%"=="2" goto colorsafe
if "%answer%"=="3" goto setcommand11
cls&goto settingssafe
:chgnyser
cls
Echo.
Echo. Current %nyser%
Echo.
set/pname2420=
cls
cls
set nyser=%name2420%
@echo nyser=%nyser%,>>config_os\%OSname%.settings
goto settingssafe

:colorsafe
cls
Echo.
Echo. Current : %rndcolor%
Echo.
set/prnc=Enter color code:
cls
cls

set rndcolor=%rnc%
color %rndcolor%

goto settingssafe

:disc
Echo.
Echo Disc drive based recovery
Echo.
Echo If you see error message, click continue , Log OS is
Echo searching all possible disc drives.
Echo.
if exist D:\ start /b "" "D:\recovery.bat"
if exist D:\ echo Drive D:\ found
if exist E:\ start /b "" "E:\recovery.bat"
if exist E:\ echo Drive E:\ found
if exist F:\ start /b "" "F:\recovery.bat"
if exist F:\ echo Drive F:\ found
if exist G:\ start /b "" "G:\recovery.bat"
if exist G:\ echo Drive G:\ found
if exist H:\ start /b "" "H:\recovery.bat"
if exist H:\ echo Drive H:\ found
if exist I:\ start /b "" "I:\recovery.bat"
if exist I:\ echo Drive I:\ found
if exist J:\ start /b "" "J:\recovery.bat"
if exist J:\ echo Drive J:\ found
if exist K:\ start /b "" "K:\recovery.bat"
if exist K:\ echo Drive K:\ found
if exist L:\ start /b "" "L:\recovery.bat"
if exist L:\ echo Drive L:\ found
if exist M:\ start /b "" "M:\recovery.bat"
if exist M:\ echo Drive M:\ found
if exist N:\ start /b "" "N:\recovery.bat"
if exist N:\ echo Drive N:\ found
if exist O:\ start /b "" "O:\recovery.bat"
if exist O:\ echo Drive O:\ found
if exist B:\ start /b "" "B:\recovery.bat"
if exist B:\ echo Drive B:\ found
if exist P:\ start /b "" "P:\recovery.bat"
if exist P:\ echo Drive P:\ found
if exist X:\ start /b "" "X:\recovery.bat"
if exist X:\ echo Drive X:\ found
if exist Z:\ start /b "" "Z:\recovery.bat"
if exist Z:\ echo Drive Z:\ found
if exist A:\ start /b "" "A:\recovery.bat"
if exist A:\ echo Drive A:\ found
pause
goto setcommand11

:safehelp
Echo
Echo ?             = Shows this screen
Echo Settings      = Set up batch file
Echo About         = View information about safe mode
Echo LogOSnormal   = Starts LogOS normally
Echo Restart       = Shutdowns and starts OS again
Echo Shutdown      = Closes OS
Echo Disc          = Disc based recovery
Echo Recovery      = Starts recovery mode
Echo CMD           = Start's Command Prompt to solve
Echo                 some problems.
Echo Clearcache    = Clears all variables
Echo Reload        = Reloads all variables
Echo Update        = Start's LogOS update utility
Echo Fix           = Diagnose and fix errors
Echo.                automatically.
goto setcommand11

:booterror
:conprocess
call :booterror1
@echo.>>log_os\Shutdown
if "%sos%"=="true" title EXIT
@echo.>>skiptoskamp
reg add "HKCU\Software\Microsoft\Command Processor" /v DefaultColor /t REG_DWORD /d 15 /f >nul
if exist log_os\lgr del log_os\lgr
goto autosetup

:booterror1
goto :eof
:standby
color 07
ping localhost -n 1 >nul
color 08
ping localhost -n 1 >nul
cls
if not "%compat%"=="true" bg cursor 0
ping localhost -n 1 >nul
color 07
if not "%live%"=="true" Echo. Closed in standby >>log_os\log.txt
cls
cls
cls
cls
cls
Echo.
Echo.
Echo.
Pause>nul
goto start

:customapp
cls
Echo.
echo Custom app launcher
Echo.
echo 1. View installed custom Log OS applications
echo 2. Install an application
echo 3. Launch a batch file
echo 4. Return to start screen
echo.
set/panswer=Your selection:
if "%answer%"=="1" goto logosapp
if "%answer%"=="2" goto installapp
if "%answer%"=="3" goto custombatch
if "%answer%"=="4" goto start

:logosapp
cls
echo.
echo Installed applications:
echo.
echo These applications can simply be run using the run command
echo at the start screen.
echo.
set /a appid=1
for /f "delims=" %%a in ('dir /b apps_user apps_os') do (
call apps\%%a -getinfo !appid!
set cm=%%a
echo.   Command: !cm:.bat=!
set "cm="
set /a appid+=1
)
echo.
pause
goto customapp

:installapp
cls
echo.
echo Install an application
echo.
echo This allows you to install a Log OS application. DO NOT USE THIS
echo COMMAND TO INSTALL ANY BATCH FILE^^! Any existing applications
echo will be overwritten with the new version.
echo.
set /p source=Drag the installable application in this window or enter the specific path:
copy %source% apps /y
cls
echo.
echo Installation finished
echo.
echo Type the name of the application in the start screen to
echo launch it.
echo.
pause
goto customapp

:launchlogapp
if "%user%"=="" (
cls
echo.
echo This action is not allowed
echo.
echo For security reasons, this account cannot
echo launch ANY external application.
echo.
pause
goto start
)
if not "%live%"=="true" @echo. Failed to shut down installed %osname% app correctly>>log_os\log.txt
if exist "apps_user\%answer%.bat" cmd /K "apps_user\%answer%.bat"
if exist "apps_user\%answer%" cmd /K "apps_user\%answer%"
if exist log_os\log.txt del log_os\log.txt
mode %screen_w%,%screen_h%
goto start

:custombatch
cls
echo.
echo Custom batch file or application
echo.
echo Please note that these applications may not be
echo designed with Log OS in mind and should have an
echo exit command built in. If you see an emergency
echo prompt after exiting a program, just type 'exit'
echo to return to Log OS.
Echo.
set/panswer=Enter app name:
cls
cls
if not "%live%"=="true" @echo. Failed to shut down custom app correctly>>log_os\log.txt
if exist "%answer%.bat" cmd /K "%answer%.bat"
if exist "%answer%.cmd" cmd /K "%answer%.cmd"
if exist "%answer%.exe" cmd /K "%answer%.exe"
if exist "%answer%" cmd /K "%answer%"
if exist log_os\log.txt del log_os\log.txt
goto start

:cal
if not "%live%"=="true" @echo. Calculator's critical error>>log_os\log.txt
set answer=NaN
cls
Echo.
Echo Enter what to compute
Echo.
Echo. Exaple : 5*8 (12+1)
Echo.
set/pcal=
cls
cls
set/aanswer=%cal%
cls
Echo.
Echo Answer is %answer%
Echo.
Pause
goto start

:makeinfo
goto bootg

:createboot
if exist boot_os\logos_logo.bat del boot_os\logos_logo.bat
@echo :logo>>boot_os\logos_logo.bat
@echo Echo.>>boot_os\logos_logo.bat
@echo Echo. ³        ÚÄÄÄÄÄ¿   ÚÄÄÄÄÄÄ      ÚÄÄÄÄÄ¿  ÚÄÄÄÄÄÄ>>boot_os\logos_logo.bat
@echo Echo. ³ù       ³ùùùùù³   ³ ùùùù       ³ùùùùù³  ³ùùùùùù>>boot_os\logos_logo.bat
@echo Echo. ³ù       ³ù ù ù³   ³ ùÄÄÄ¿      ³ù ù ù³  ÀÄÄÄÄÄ¿>>boot_os\logos_logo.bat
@echo Echo. ³ùùùù    ³ùùùùù³   ³ ùùùù³      ³ùùùùù³  ùùùùùù³>>boot_os\logos_logo.bat
@echo Echo. ÀÄÄÄÄÄ   ÀÄÄÄÄÄÙ   ÀÄÄÄÄÄÙ      ÀÄÄÄÄÄÙ  ÄÄÄÄÄÄÙ>>boot_os\logos_logo.bat
goto :eof

:cdskinfo
if exist error del error
echo error>>error
goto logos

:createlogo
cls
if exist boot_os\logos_logo.bat del boot_os\logos_logo.bat
Echo Creating boot image...
@echo :logo>>boot_os\logos_logo.bat
@echo Echo.>>boot_os\logos_logo.bat
@echo Echo. ³        ÚÄÄÄÄÄ¿   ÚÄÄÄÄÄÄ      ÚÄÄÄÄÄ¿  ÚÄÄÄÄÄÄ>>boot_os\logos_logo.bat
@echo Echo. ³ù       ³ùùùùù³   ³ ùùùù       ³ùùùùù³  ³ùùùùùù>>boot_os\logos_logo.bat
@echo Echo. ³ù       ³ù ù ù³   ³ ùÄÄÄ¿      ³ù ù ù³  ÀÄÄÄÄÄ¿>>boot_os\logos_logo.bat
@echo Echo. ³ùùùù    ³ùùùùù³   ³ ùùùù³      ³ùùùùù³  ùùùùùù³>>boot_os\logos_logo.bat
@echo Echo. ÀÄÄÄÄÄ   ÀÄÄÄÄÄÙ   ÀÄÄÄÄÄÙ      ÀÄÄÄÄÄÙ  ÄÄÄÄÄÄÙ>>boot_os\logos_logo.bat
Echo.
ansicon -m4C -e 
call boot_os\logos_logo.bat
Echo.
goto setcommand21
:startupcommand
cls
goto eCMD222
:cmd211
:setcommand211
:setcommand221
:setcommand11
if "%dash%"=="" set dash=on
if "%dash%"=="on" set/pcommand=%d%^>
if "%dash%"=="off" set/pcommand=%d%
set answer=%command%

:Command
if "%answer%"=="shutdown" goto shutdown
if "%answer%"=="login" goto logsafe
if "%answer%"=="Login" goto logsafe
if "%answer%"=="LOGIN" goto logsafe
if "%answer%"=="Shutdown" goto shutdown
if "%answer%"=="SHUTDOWN" goto shutdown
if "%answer%"=="restart" goto restart
if "%answer%"=="Restart" goto restart
if "%answer%"=="RESTART" goto restart
if "%answer%"=="About" goto about2
if "%answer%"=="about" goto about2
if "%answer%"=="ABOUT" goto about2
if "%answer%"=="?" goto safehelp
if "%answer%"=="Logosnormal" set OSname=LogOS&del log_os\LogOS_is_running&del log_os\log.txt&echo.>>log_os\Shutdown&goto sldkd
if "%answer%"=="LogOSnormal" set OSname=LogOS&del log_os\LogOS_is_running&del log_os\log.txt&echo.>>log_os\Shutdown&goto sldkd
if "%answer%"=="LogOSNormal" set OSname=LogOS&del log_os\LogOS_is_running&del log_os\log.txt&echo.>>log_os\Shutdown&goto sldkd
if "%answer%"=="logosnormal" set OSname=LogOS&del log_os\LogOS_is_running&del log_os\log.txt&echo.>>log_os\Shutdown&goto sldkd
if "%answer%"=="LOGOSNORMAL" set OSname=LogOS&del log_os\LogOS_is_running&del log_os\log.txt&echo.>>log_os\Shutdown&goto sldkd
if "%answer%"=="LogOSNORMAL" set OSname=LogOS&del log_os\LogOS_is_running&del log_os\log.txt&echo.>>log_os\Shutdown&goto sldkd
if "%answer%"=="LOGOSnormal" set OSname=LogOS&del log_os\LogOS_is_running&del log_os\log.txt&echo.>>log_os\Shutdown&goto sldkd
if "%command%"=="clear" cls&goto setcommand11
if "%command%"=="dash off" set "dash=off"goto setcommand11
if "%command%"=="dash on" set "dash=on"&goto setcommand11
if "%command:~0,4%"=="dash" set d=%command:~5%&goto setcommand11
if "%qin%"=="login" (
if "%answer:~0,5%"=="print" (
if exist "%answer:~6%" (
for /f "delims=" %%a in (%answer:~6%) do echo %%a
goto setcommand11
)
)
)
if "%command:~0,5%"=="print" Echo %command:~6%&goto setcommand11
if "%command:~0,5%"=="Print" Echo %command:~6%&goto setcommand11
if "%command:~0,5%"=="PRINT" Echo %command:~6%&goto setcommand11
if "%command:~0,4%"=="bgfg" color %command:~5%&goto setcommand11
if "%qin%"=="" echo Access is denied.&goto lst
if not "%qin%"=="login" echo Access is denied.&goto lst

if "%answer:~0,2%"=="xc" goto executext
if "%answer%"=="logout" goto lotsafe
if "%answer%"=="settings" goto settingssafe
if "%answer%"=="Settings" goto settingssafe
if "%answer%"=="SETTINGS" goto settingssafe
if "%answer%"=="disc" goto disc
if "%answer%"=="Disc" goto disc
if "%answer%"=="DISC" goto disc
if "%command:~0,4%"=="note" goto setcommand11
if "%answer%"=="cmd" goto sfcmd
if "%answer%"=="Cmd" goto sfcmd
if "%answer%"=="CMD" goto sfcmd
if "%answer%"=="cMD" goto sfcmd
if "%answer%"=="cmD" goto sfcmd
if "%answer%"=="cMd" goto sfcmd
if "%answer%"=="CMd" goto sfcmd
if "%answer%"=="noresetnormal" set autoreset=false&@echo.autoreset=false,>>config_os\%OSname%.settings&del log_os\LogOS_is_running&del log_os\log.txt&goto logos
if "%answer%"=="Noresetnormal" set autoreset=false&@echo.autoreset=false,>>config_os\%OSname%.settings&del log_os\LogOS_is_running&del log_os\log.txt&goto logos
if "%answer%"=="NORESETNORMAL" set autoreset=false&@echo.autoreset=false,>>config_os\%OSname%.settings&del log_os\LogOS_is_running&del log_os\log.txt&goto logos
if "%answer%"=="Clearcache" goto aasfffff
if "%answer%"=="clearcache" goto aasfffff
if "%answer%"=="ClearCache" goto aasfffff
if "%answer%"=="CLEARCACHE" goto aasfffff
if "%answer%"=="CLEARcache" goto aasfffff
if "%answer%"=="reload" for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if "%answer%"=="Reload" for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if "%answer%"=="ReLoad" for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if "%answer%"=="RELOAD" for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if "%answer%"=="fix" goto fixerrors
if "%answer%"=="Fix" goto fixerrors
if "%answer%"=="FIX" goto fixerrors
if "%adaccess%"=="" goto lst
if not "%adaccess%"=="true" goto lst
if "%answer%"=="Recovery" goto sfrec
if "%answer%"=="recovery" goto sfrec
if "%answer%"=="RECOVERY" goto sfrec
if "%answer%"=="compatibility" call :compatmode
if "%answer%"=="Compatibility" call :compatmode
if "%answer%"=="COMPATIBILITY" call :compatmode
if "%answer%"=="compatibility +save" goto savecompatmode
if "%answer%"=="Update" goto systemupdate
if "%answer%"=="update" goto systemupdate
if "%answer%"=="UPDATE" goto systemupdate
if exist "%answer%" cmd /k %answer%
if exist "%answer%.bat" cmd /k "%answer%.bat"
if exist "%answer%.exe" cmd /k "%answer%.exe"
if "%command:~0,18%"=="system -makedomain" SET domain=%command:~19%&@echo.domain=%command:~19%,>>config_os\%OSname%.settings&echo Commmand complited successfully&goto setcommand11
if "%command%"=="exit" goto setcommand11
if "%command%"=="system -Llogon +fixnumbers" goto fixnumbr
if "%command%"=="system -hibernate" set restore=setcommand11&goto hiber
if "%command%"=="system -shutdown" goto shutdown
if "%command%"=="system -restart" goto restart
if "%command%"=="system -restart +recovery" set /p reason=Enter reason:&goto sfrec
if "%command%"=="system -restart +hot" goto hoting
if "%command%"=="system -noclose +true" set nos=true&Echo Command complited successfully&goto setcommand11
if "%command%"=="system -noclose -false" set nos=&Echo Command complited successfully&goto setcommand11
if "%command%"=="system -get time" Echo %time%&goto setcommand11
if "%command%"=="system -makeinstaller +automated" goto makeinstaller
if "%command%"=="reg -fscreen for each now add resume=settings&set user=%user%" echo Command cannot be complited&goto setcommand11
if "%command%"=="reg +fscreen for each now add resume=settings&set user=%user%" echo Command cannot be complited&goto setcommand11
if "%command%"=="calculator" echo Cannot open calculator&goto setcommand11
if "%command%"=="time" echo Cannot open time&goto setcommand11
if "%command%"=="explorer" echo Cannot open explorer&goto setcommand11
if "%command%"=="notes" echo Cannot open notes&goto setcommand11
if "%command%"=="settings" echo Cannot open settings&goto setcommand11
if "%command%"=="fastnote" echo Cannot open fastnote&goto setcommand11
if "%command%"=="dance" goto danceniw
if "%command%"=="open" set console=false&goto LogOS
if "%command%"=="system -start +hang" goto rain222
if "%command%"=="eCMD" goto eCMD222
if "%command%"=="system -start" set console=false&goto LogOS
if "%command%"=="system -start +addscreen" goto cbs222
if "%command%"=="system -start -delscreen" goto dbs222
if "%command%"=="system -get version" call :passit&echo Log OS %version%&goto setcommand11
if "%command%"=="system -fix +logo" call :createlogo&goto setcommand21
if "%command%"=="system -showlogo" ansicon -m4C -e &call boot_os\logos_logo.bat&goto setcommand11
if "%command%"=="gedit" Echo Cannot open gedit&goto setcommand11
if "%command%"=="system -fix +bootloader" goto fixingmbr
if "%command%"=="system -recover +factory" goto resetall
if "%command%"=="system -load +variables" goto load
if "%command%"=="system -list +users" goto listusr
if "%command%"=="chkbat /f /c" set force=true&goto checklogos
if "%command%"=="chkbat /c" goto checklogos
if "%command%"=="resvar /p" goto checkprompt
if "%command%"=="bootrec /checkboot" goto checkbooterror
if "%command%"=="bootrec /checkboot /f" set force=true&goto checkbooterror
if "%command:~0,24%"=="system -modifyvariable +" goto changevarlogin
if "%command%"=="system -factory +full +customize=yes" goto factoryFa
if "%command%"=="system -factory +full +customize=no" goto factoryFb
if exist "%command%" cmd /k %command%&goto setcommand11
Echo Bad file or command name
:lst
goto setcommand11
:factoryFa
echo.
echo Deleting sound driver....
@echo.::log_os\terminates sound driver>>log_os\terminate
if exist boot_os\Sound.bat del boot_os\Sound.bat
echo Deleting Log OS boot image...
if exist boot_os\logos_logo.bat del boot_os\logos_logo.bat
echo Deleting Log OS settings file...
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
echo Wiping variables...
SET userg=
SET n=
SET ip=
SET rndcolor=
SET adminpass=
SET answer5=
SET pw=
SET pp=
SET userdescription=
set hibernated=
set restore=
set usercolor=
set admincol=
set logoncolor=
set guestcolor=
SET factory=
SET noguest=
SET autoreset=
SET adno=
SET an=
SET gn=
SET adname=
SET admindescript=
SET classic=
SET fullscreen=
SET autologon=
SET loginname=
SET nopass=
SET noupass=
SET domain=
SET domainusername=
SET domainpassword=
SET domaindescription=
SET description=
SET user=
SET password=
SET domaincolor=
SET resolution=
SET restart=
set attempts=
echo Setting new variables into the memory...
set factory=yes
set hibernated=false
echo Saving variables to the settings file...
@echo.factory=yes,>>config_os\%OSname%.settings
@echo.hibernated=false,>>config_os\%OSname%.settings
echo Restarting the system...
start "" %0
@echo.>>log_os\Shutdown
if exist log_os\lgr del log_os\lgr
exit

:executext
%answer:~3%
goto setcommand11

:factoryFb
echo.
echo Deleting sound driver....
@echo.::log_os\terminates sound driver>>log_os\terminate
if exist boot_os\Sound.bat del boot_os\Sound.bat
echo Deleting Log OS boot image...
if exist boot_os\logos_logo.bat del boot_os\logos_logo.bat
echo Deleting Log OS settings file...
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
echo Wiping variables...
SET userg=
SET n=
SET ip=
SET rndcolor=
SET adminpass=
SET answer5=
SET pw=
SET pp=
SET userdescription=
set hibernated=
set restore=
set usercolor=
set admincol=
set logoncolor=
set guestcolor=
SET factory=
SET noguest=
SET autoreset=
SET adno=
SET an=
SET gn=
SET adname=
SET admindescript=
SET classic=
SET fullscreen=
SET autologon=
SET loginname=
SET nopass=
SET noupass=
SET domain=
SET domainusername=
SET domainpassword=
SET domaindescription=
SET description=
SET user=
SET password=
SET domaincolor=
SET resolution=
SET restart=
set attempts=
echo Setting new variables into the memory...
set factory=
set customize=
set bootloader=
set recover=
echo Restarting the system...
start "" %0
@echo.>>log_os\Shutdown
if exist log_os\lgr del log_os\lgr
exit

:danceniw
echo Error
goto setcommand11

:changevarlogin
Echo.
set /p %command:~24%=
@echo %command:~24%=!%command:~24%!,>>config_os\%OSname%.settings
goto setcommand11

:load
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
Echo Command complited successfully
goto setcommand11

:checkbooterror
if "%force%"=="true" set lastforce=true
Echo.
Echo Attempting to fix startup problems
Echo Please wait...
Echo.
Echo Depending on disk speed of your computer,
Echo this might take some seconds to complite...
del boot_os\logos_logo.bat
@echo :logo>>boot_os\logos_logo.bat
@echo Echo.>>boot_os\logos_logo.bat
@echo Echo.    ³        ÚÄÄÄÄÄ¿   ÚÄÄÄÄÄÄ      ÚÄÄÄÄÄ¿  ÚÄÄÄÄÄÄ>>boot_os\logos_logo.bat
@echo Echo.    ³ù       ³ùùùùù³   ³ ùùùù       ³ùùùùù³  ³ùùùùùù>>boot_os\logos_logo.bat
@echo Echo.    ³ù       ³ù ù ù³   ³ ùÄÄÄ¿      ³ù ù ù³  ÀÄÄÄÄÄ¿>>boot_os\logos_logo.bat
@echo Echo.    ³ùùùù    ³ùùùùù³   ³ ùùùù³      ³ùùùùù³  ùùùùùù³>>boot_os\logos_logo.bat
@echo Echo.    ÀÄÄÄÄÄ   ÀÄÄÄÄÄÙ   ÀÄÄÄÄÄÙ      ÀÄÄÄÄÄÙ  ÄÄÄÄÄÄÙ>>boot_os\logos_logo.bat
set pimpom=true
goto refresherrors1
:finishrec
set pimpom=
if "%autologon%"=="" set autologon=false
if "%autologon%"=="false" goto skipmeme
if "%lastforce%"=="true" set lastforce=&goto forceset
if "%adno%"=="true" goto checkguest211
set loginname=%adname%
goto skipmeme
:checkuser
set loginname=%userg%
goto skipmeme
:checkguest211
if "%noguest%"=="true" goto checkuser
set loginname=Guest
:skipmeme
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
echo ::WARNING!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
::

@echo ip=%ip%,>> config_os\%OSname%.settings
@echo rndcolor=%rndcolor%,>> config_os\%OSname%.settings
@echo adminpass=%adminpass%,>> config_os\%OSname%.settings


@echo hibernated=false,>> config_os\%OSname%.settings
set t=
@echo admincol=%admincol%,>>config_os\%OSname%.settings
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings

@echo factory=false,>>config_os\%OSname%.settings
set t=

@echo admincol=%admincol%,>>config_os\%OSname%.settings
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings
@echo noguest=%noguest%,>> config_os\%OSname%.settings
@echo logoncolor=%logoncolor%,>> config_os\%OSname%.settings
@echo autoreset=%autoreset%,>>config_os\%OSname%.settings
@echo adname=%adname%,>>config_os\%OSname%.settings
@echo adno=%adno%,>>config_os\%OSname%.settings
@echo admindescript=%admindescript%,>>config_os\%OSname%.settings
@echo classic=%classic%,>>config_os\%OSname%.settings
@echo autologon=%autologon%,>>config_os\%OSname%.settings
@echo loginname=%loginname%,>>config_os\%OSname%.settings
@echo nopass=%nopass%,>>config_os\%OSname%.settings
@echo noupass=%noupass%,>>config_os\%OSname%.settings
@echo compatibility=%compatibility%,>>config_os\%OSname%.settings
::@echo resolution=%resolution%,>>config_os\%OSname%.settings
@echo constart=%constart%,>>config_os\%OSname%.settings
@echo sounded=%sounded%,>>config_os\%OSname%.settings
@echo oldstart=%oldstart%,>> config_os\%OSname%.settings
Echo.
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if exist config_os\%OSname%.settings Echo Command complited successfully.
if not exist config_os\%OSname%.settings Echo Startup repair wasn't able to fix any errors.&Echo.&Echo Command failed to complite successfully.
goto cmd211

:forceset
if "%adno%"=="true" set adno=false
set adname=Administrator
set autologon=false
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
echo ::WARNING!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
::

@echo ip=%ip%,>> config_os\%OSname%.settings
@echo rndcolor=%rndcolor%,>> config_os\%OSname%.settings
@echo adminpass=%adminpass%,>> config_os\%OSname%.settings


@echo hibernated=false,>> config_os\%OSname%.settings
set t=
@echo admincol=%admincol%,>>config_os\%OSname%.settings
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings

@echo factory=false,>>config_os\%OSname%.settings
set t=

@echo admincol=%admincol%,>>config_os\%OSname%.settings
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings
@echo noguest=%noguest%,>> config_os\%OSname%.settings
@echo logoncolor=%logoncolor%,>> config_os\%OSname%.settings
@echo autoreset=%autoreset%,>>config_os\%OSname%.settings
@echo adname=%adname%,>>config_os\%OSname%.settings
@echo adno=%adno%,>>config_os\%OSname%.settings
@echo admindescript=%admindescript%,>>config_os\%OSname%.settings
@echo classic=%classic%,>>config_os\%OSname%.settings
@echo autologon=%autologon%,>>config_os\%OSname%.settings
@echo loginname=%adname%,>>config_os\%OSname%.settings
@echo nopass=%nopass%,>>config_os\%OSname%.settings
@echo noupass=%noupass%,>>config_os\%OSname%.settings
@echo compatibility=%compatibility%,>>config_os\%OSname%.settings
::@echo resolution=%resolution%,>>config_os\%OSname%.settings
@echo constart=%constart%,>>config_os\%OSname%.settings
@echo sounded=%sounded%,>>config_os\%OSname%.settings
@echo oldstart=%oldstart%,>> config_os\%OSname%.settings
goto skipmeme

:checkprompt
Echo.
Echo. Variable reset utility
Echo.
set /p answer=Would you like to reset userg?
if "%answer%"=="Y" set userg=
if "%answer%"=="y" set userg=
set /p answer=Would you like to reset adminpass?
if "%answer%"=="Y" set adminpass=administratorhasmanyrights
if "%answer%"=="y" set adminpass=administratorhasmanyrights
set /p answer=Would you like to reset autologon?
if "%answer%"=="Y" set autologon=false
if "%answer%"=="y" set autologon=false
set /p answer=Would you like to reset loginname?
if "%answer%"=="Y" set loginname=Administrator&set adno=false&set autologon=true
if "%answer%"=="y" set loginname=Administrator&set adno=false&set autologon=true
set /p answer=Would you like to reset hibernated?
if "%answer%"=="Y" set hibernated=false&set restore=
if "%answer%"=="y" set hibernated=false&set restore=
Echo Saving data...
if "%sos%"=="true" title Deleting %OSname% settings
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
if "%sos%"=="true" title Saving date
echo ::WARNING!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
::
if "%sos%"=="true" title Saving username

if "%sos%"=="true" title Saving user number
if "%sos%"=="true" title Saving incorrect password message
@echo ip=%ip%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving default color
@echo rndcolor=%rndcolor%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving admin password
@echo adminpass=%adminpass%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving plugins



if "%sos%"=="true" title Saving user description

if "%sos%"=="true" title Saving hibernate state
@echo hibernated=false,>> config_os\%OSname%.settings
if "%sos%"=="true" title Setting time
set t=
if "%sos%"=="true" title Saving colors
@echo admincol=%admincol%,>>config_os\%OSname%.settings
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings

if "%sos%"=="true" title Saving factory settin
@echo factory=false,>>config_os\%OSname%.settings
if "%sos%"=="true" title Setting time
set t=
if "%sos%"=="true" title Saving colors

@echo admincol=%admincol%,>>config_os\%OSname%.settings
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings
@echo noguest=%noguest%,>> config_os\%OSname%.settings
@echo logoncolor=%logoncolor%,>> config_os\%OSname%.settings
if "%sos%"=="true" title Saving autoreset setting
@echo autoreset=%autoreset%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving admin name
@echo adname=%adname%,>>config_os\%OSname%.settings
@echo adno=%adno%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving admin description
@echo admindescript=%admindescript%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving logon type
@echo classic=%classic%,>>config_os\%OSname%.settings
if "%sos%"=="true" title Saving autologon settings
@echo autologon=%autologon%,>>config_os\%OSname%.settings
@echo loginname=%loginname%,>>config_os\%OSname%.settings
@echo nopass=%nopass%,>>config_os\%OSname%.settings
@echo noupass=%noupass%,>>config_os\%OSname%.settings
@echo compatibility=%compatibility%,>>config_os\%OSname%.settings
::@echo resolution=%resolution%,>>config_os\%OSname%.settings
@echo constart=%constart%,>>config_os\%OSname%.settings
@echo sounded=%sounded%,>>config_os\%OSname%.settings
@echo oldstart=%oldstart%,>> config_os\%OSname%.settings
title Welcome %user% to %OSname% safe mode
if exist config_os\%OSname%.settings Echo Command complited successfully
if not exist config_os\%OSname%.settings Echo Command failed to complite successfully
goto setcommand11
:temperr
Echo Temporary error, returning to prompt
Echo.
Echo Command complited successfully
goto setcommand11
:checklogos
if "%adno%"=="" goto skiplstuser
Echo Performing write test
@echo.>>Test_write.txt
Echo Checking for Test_write.txt
if not exist Test_write.txt goto makec
Echo Found, deleting it...
del Test_write.txt
Echo Wiping cache...
SET userg=
SET n=
SET ip=
SET rndcolor=
SET adminpass=
SET answer5=
SET pw=
SET pp=
SET userdescription=
set hibernated=
set restore=
set usercolor=
set admincol=
set logoncolor=
set guestcolor=
SET factory=
SET noguest=
SET autoreset=
SET adno=
SET an=
SET gn=
SET adname=
SET admindescript=
SET classic=
SET fullscreen=
SET autologon=
SET loginname=
SET nopass=
SET noupass=
SET now=
SET domain=
Echo Loading settings
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if "%force%"=="true" set force=&goto refresherrors1
Echo Checking if error is temporary
if "%autologon%"=="" goto refresherrors1
if "%classic%"=="" goto refresherrors1
if "%hibernated%"=="" goto refresherrors1
if "%factory%"=="" goto refresherrors1
goto temperr
:refresherrors1
if not "%pepom%"=="true" Echo Performing system refresh...
if not "%pepom%"=="true" Echo System is trying to fix errors. Please wait...
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
del config_os\%OSname%.settings
echo ::WARNING!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
::

@echo ip=%ip%,>> config_os\%OSname%.settings
if "%rndcolor%"=="" set rndcolor=07
@echo rndcolor=%rndcolor%,>> config_os\%OSname%.settings
if "%adminpass%"=="" set adminpass=administratorhasmanyrights
@echo adminpass=%adminpass%,>> config_os\%OSname%.settings



if "%hibernated%"=="" set hibernated=false
@echo hibernated=%hibernated%,>>config_os\%OSname%.settings
:resumerestore12
@echo restore=%restore%,>>config_os\%OSname%.settings
if "%usercolor%"=="" set usercolor=07

if "%admincol%"=="" set admincol=07
@echo admincol=%admincol%,>>config_os\%OSname%.settings
if "%logoncolor%"=="" set logoncolor=07
@echo logoncolor=%logoncolor%,>>config_os\%OSname%.settings
if "%guestcolor%"=="" set guestcolor=07
@echo guestcolor=%guestcolor%,>>config_os\%OSname%.settings
if "%factory%"=="" set factory=no
@echo factory=no,>> config_os\%OSname%.settings
if "%noguest%"=="" set noguest=false
@echo noguest=%noguest%,>> config_os\%OSname%.settings
if "%autoreset%"=="" set autoreset=true
@echo autoreset=%autoreset%,>>config_os\%OSname%.settings
if "%adno%"=="" set adno=false
@echo adno=%adno%,>>config_os\%OSname%.settings
if "%adname%"=="" set adname=Administrator
@echo adname=%adname%,>>config_os\%OSname%.settings
@echo admindescript=%admindescript%,>>config_os\%OSname%.settings
if "%classic%"=="" set classic=false
@echo classic=%classic%,>>config_os\%OSname%.settings
if "%autologon%"=="" set autologon=false
@echo autologon=%autologon%,>>config_os\%OSname%.settings
@echo loginname=%loginname%,>>config_os\%OSname%.settings
if "%nopass%"=="" set nopass=no
if "%noupass%"=="" set noupass=false
@echo nopass=%nopass%,>>config_os\%OSname%.settings
@echo noupass=%noupass%,>>config_os\%OSname%.settings
@echo compatibility=no,>>config_os\%OSname%.settings
if "%domain%"=="" set domain=logos_settings
if "%domain%"=="logos_settings" @echo domain=logos_settings,>>config_os\%OSname%.settings
if "%resolution%"=="" set resolution=seven
::@echo resolution=%resolution%,>>config_os\%OSname%.settings
if "%constart%"=="" set constart=false&@echo constart=%constart%,>>config_os\%OSname%.settings
if "%skiplogos%"=="true" set constart=true
if "%oldstart%"=="" set oldstart=false
@echo oldstart=%oldstart%,>> config_os\%OSname%.settings
if "%sounded%"=="" set sounded=true&@echo sounded=%sounded%,>>config_os\%OSname%.settings
title Please wait..
if not "%pepom%"=="true" Echo Checking variables
if not "%autologon%"=="" set handleone=succ
set handletwo=%handleone%
if "%sos%"=="true" title Checking logos_settings
if exist config_os\%OSname%.settings set handleone=%handletwo%ess
if "%sos%"=="true" title Checking checking results
if "%pempom%"=="true" goto finishrec
if "%handleone%"=="success" del log_os\log.txt&Echo Command complited succcessfully&goto setcommand11
if "%sos%"=="true" title Checking for other errors...
if "%handleone%"=="ess" goto makec
if "%handleone%"=="" goto wcfix
goto booterror



:listusr
if "%adno%"=="" goto skiplstuser
if not "%adno%"=="true" Echo. %adname%
if not "%noguest%"=="true" Echo. Guest
if not "%userg%"=="" Echo. %userg%
Echo.
Echo Command complited successfully
goto setcommand11

:skiplstuser
Echo. You have no variables loaded. Please load
Echo. variables using the following command:
Echo.
Echo. system -load +variables
Echo.
Echo Command failed to complite successfully
goto setcommand11

:resetall
Echo Deleting boot image and replacing with factory default
if exist boot_os\logos_logo.bat del boot_os\logos_logo.bat
Echo Deleting settings
if exist config_os\%OSname%.settings del config_os\%OSname%.settings
set factory=no
if not "%live%"=="true" @echo. Factory reset unexeptedly stopped!>>log_os\log.txt
Echo Writing settings
echo ::WARNING!>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::To avoid errors in Log OS, please don't edit this file>>config_os\%OSname%.settings
echo ::>>config_os\%OSname%.settings
echo ::Saved at : %date% %time%>>config_os\%OSname%.settings
::
ping localhost -n 1 >nul
set t=
ping localhost -n 2 >nul
@echo admindescript=%admindescript%,>>config_os\%OSname%.settings
ping localhost -n 2 >nul
set answer5=Your selection:
ping localhost -n 2 >nul
set restore=logos
ping localhost -n 2 >nul
ping localhost -n 2 >nul
@echo hibernated=false,>>config_os\%OSname%.settings
@echo factory=no,>>config_os\%OSname%.settings
@echo logoncolor=07,>>config_os\%OSname%.settings
@echo usercolor=07,>>config_os\%OSname%.settings
@echo admincol=07,>>config_os\%OSname%.settings
@echo rndcolor=07,>> config_os\%OSname%.settings
@echo guestcolor=07,>>config_os\%OSname%.settings
@echo noguest=false,>>config_os\%OSname%.settings
ping localhost -n 2 >nul
ping localhost -n 2 >nul
set user=%nothing%
title Welcome %user%to %OSname%
@echo userg=,>> config_os\%OSname%.settings
ping localhost -n 1 >nul
@echo ip=,>> config_os\%OSname%.settings
@echo autoreset=true,>>config_os\%OSname%.settings
ping localhost -n 1 >nul
@echo adno=false,>>config_os\%OSname%.settings
@echo adname=Administrator,>>config_os\%OSname%.settings
ping localhost -n 1 >nul
@echo classic=false,>>config_os\%OSname%.settings
@echo autologon=disabled,>>config_os\%OSname%.settings
@echo loginname=,>>config_os\%OSname%.settings
@echo nopass=no,>>config_os\%OSname%.settings
@echo noupass=false,>>config_os\%OSname%.settings
@echo compatibility=no,>>config_os\%OSname%.settings
@echo domain=logos_settings,>>config_os\%OSname%.settings
@echo resolution=7,>>config_os\%OSname%.settings
@echo constart=false,>>config_os\%OSname%.settings
@echo sounded=%sounded%,>>config_os\%OSname%.settings
@echo oldstart=false,>> config_os\%OSname%.settings
Echo Saving final settings and restarting LogOS
set user=%f1%
if exist log_os\log.txt del log_os\log.txt
if exist log_os\LogOS_is_running del log_os\LogOS_is_running
reg add HKCU\Console\ /v Fullscreen /t REG_DWORD /d 0 /f >nul
@echo adminpass=administratorhasmanyrights,>>config_os\%OSname%.settings
@echo Starting fresh>>log_os\freshboot
set desktop=
set console=false
if exist log_os\lgr del log_os\lgr
start /b "" %0
exit
:rain222
if exist log_os\log.txt del log_os\log.txt
if not "%live%"=="true" @echo. System force hanged by the user.>>log_os\log.txt
goto rain

:makeinstaller
Echo Please wait...
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
if exist config_os\autoinstaller.bat del config_os\autoinstaller.bat
@echo echo off>>config_os\autoinstaller.bat
@echo cls>>config_os\autoinstaller.bat
@echo automated=true,>>config_os\autoinstaller.bat
@echo bootloader=true,>>config_os\autoinstaller.bat
@echo recover=false,>>config_os\autoinstaller.bat
@echo if exist log_os\Shutdown del log_os\Shutdown>>config_os\autoinstaller.bat
@echo if exist boot_os\logos_logo.bat del boot_os\logos_logo.bat>>config_os\autoinstaller.bat
@echo if exist config_os\%OSname%.settings del config_os\%OSname%.settings>>config_os\autoinstaller.bat
@echo userg=%userg%,>>config_os\autoinstaller.bat
@echo ip=%ip%,>>config_os\autoinstaller.bat
@echo rndcolor=%rndcolor%,>>config_os\autoinstaller.bat
@echo adminpass=%adminpass%,>>config_os\autoinstaller.bat
@echo pp=%pp%,>>config_os\autoinstaller.bat
@echo userdescription=%userdescription%,>>config_os\autoinstaller.bat
@echo hibernated=false,>>config_os\autoinstaller.bat
@echo restore=%restore%,>>config_os\autoinstaller.bat
@echo usercolor=%usercolor%,>>config_os\autoinstaller.bat
@echo admincol=%admincol%,>>config_os\autoinstaller.bat
@echo guestcolor=%guestcolor%,>>config_os\autoinstaller.bat
@echo factory=no,>>config_os\autoinstaller.bat
@echo noguest=%noguest%,>>config_os\autoinstaller.bat
@echo logoncolor=%logoncolor%,>>config_os\autoinstaller.bat
@echo autoreset=%autoreset%,>>config_os\autoinstaller.bat
@echo adname=%adname%,>>config_os\autoinstaller.bat
@echo adno=%adno%,>>config_os\autoinstaller.bat
@echo admindescript=%admindescript%,>>config_os\autoinstaller.bat
@echo classic=%classic%,>>config_os\autoinstaller.bat
@echo autologon=%autologon%,>>config_os\autoinstaller.bat
@echo loginname=%loginname%,>>config_os\autoinstaller.bat
@echo nopass=%nopass%,>>config_os\autoinstaller.bat
@echo noupass=%noupass%,>>config_os\autoinstaller.bat
@echo compatibility=%compatibility%,>>config_os\autoinstaller.bat
@echo domain=%domain%,>>config_os\autoinstaller.bat
@echo resolution=%resolution%,>>config_os\autoinstaller.bat
@echo constart=%constart%,>>config_os\autoinstaller.bat
@echo sounded=%sounded%,>>config_os\autoinstaller.bat
@echo start "" %0>>config_os\autoinstaller.bat
if exist config_os\autoinstaller.bat echo Command complited successfully&goto setcommand11
if not exist config_os\autoinstaller.bat echo Command failed to complite successfully&goto setcommand11
:dbs222
if exist boot_os\bootscreen1.cmd del boot_os\bootscreen1.cmd
if exist boot_os\bootscreen2.cmd del boot_os\bootscreen2.cmd
if exist boot_os\bootscreen3.cmd del boot_os\bootscreen3.cmd
if exist boot_os\bootscreen4.cmd del boot_os\bootscreen4.cmd
if exist boot_os\bootscreen5.cmd del boot_os\bootscreen5.cmd
if exist boot_os\bootscreen6.cmd del boot_os\bootscreen6.cmd
if exist boot_os\bootscreen7.cmd del boot_os\bootscreen7.cmd
if exist boot_os\bootscreen8.cmd del boot_os\bootscreen8.cmd
if exist boot_os\bootscreen9.cmd del boot_os\bootscreen9.cmd
if exist boot_os\bootscreen10.cmd del boot_os\bootscreen10.cmd
if exist boot_os\bootscreen11.cmd del boot_os\bootscreen11.cmd
if exist boot_os\bootscreen12.cmd del boot_os\bootscreen12.cmd
if exist boot_os\bootscreen13.cmd del boot_os\bootscreen13.cmd
if exist boot_os\bootscreen14.cmd del boot_os\bootscreen14.cmd
if exist boot_os\bootscreen15.cmd del boot_os\bootscreen15.cmd
if exist boot_os\bootscreen16.cmd del boot_os\bootscreen16.cmd
if exist boot_os\bootscreen17.cmd del boot_os\bootscreen17.cmd
if exist boot_os\bootscreen18.cmd del boot_os\bootscreen18.cmd
if exist boot_os\bootscreen19.cmd del boot_os\bootscreen19.cmd
if exist boot_os\bootscreen20.cmd del boot_os\bootscreen20.cmd
echo Command complited successfully
goto setcommand211

:cbs222
set /p path=Enter boot_os\bootscreen's directory:
copy "%path%" "%cd%"
if not exist "%path%" Echo Error: Directory not found
if exist "%path%" Echo Command complited successfully
goto setcommand211

:fixingmbr
Echo There is no bootloader image in newer versions of Log OS
if exist logos_bootloader.bat Echo Command complited successfully
if not exist logos_bootloader.bat Echo Command failed to complite successfully
goto setcommand211

:fixnumbr
if "%adno%"=="true" goto checkmorenumbrs
if "%noguest%"=="true" set n=2&goto cba3201
set n=3
goto cba3201

:checkmorenumbrs
if "%noguest%"=="true" set n=1&goto cba3201
set n=2
goto cba3201
:cba3201
goto setcommand11

:eCMD222
set command=help
goto cmd211


:createsound
echo Initializing audio device...
call apps_os\playwav.bat createsound
goto :eof

:waitres
goto :eof

:wcall
endlocal
set "constart="
set "admincol="
set "adminpass="
set "adname="
set "adno="
set "alogon="
set "an="
set "answer5="
set "autologon="
set "autoreset="
set "bootloader="
set "classic="
set "color="
set "compat1="
set "compatibility="
set "constart="
set "factory="
set "flashresult="
set "fullscreen="
set "gn="
set "gp32="
set "guestcolor="
set "hibernated="
set "hour="
set "live="
set "loginname="
set "logoncolor="
set "logontime="
set "min="
set "noguest="
set "nopass="
set "noupass="
set "opasswd="
set "OSname="
set "pass="
set "qin="
set "randomm="
set "reason="
set "recover=false"
set "rerec="
set "resolution="
set "returncmd="
set "rndcolor="
set "secs="
set "sel="
set "kabi="
set "sounded="
set "startinglogos="
set "starttime="
set "type="
set "user="
set "usercolor="
set "userg="
set "version="
set "tab="
set "attempt="
set "key="
set "bck="
set "hoting="
set "stagar="
set "logonsel="
set "lastsel="
prompt Emergency prompt: %ERRORLEVEL%$F
goto :eof

:wchiber
set "bck="
set "hoting="
set "kabi="
set "reason="
set "recover="
set "bck="
set "gp32="
set "tab="
set "key="
set "tab="
goto :eof

:pause_rec
call :wcall
bg _kbd
ping localhost -n 3 >nul
set key=%errorlevel%
if "%key%"=="338" color CF&ping localhost -n 5 >nul&goto nextsetup
goto logos

:nextsetup
set setup=true
if exist config_os\%OSname%.settings for /f "eol=: delims=," %%a in (config_os\%OSname%.settings) do set %%a
start /b "" %0
exit

:bg_binary_write
:: This part stores bg.exe in hex. This will be converted into binary if bg.exe is not
:: found in the host system.
::::: 4d 5a 90 00 03 00 00 00  04 00 00 00 ff ff 00 00   MZ..............
::::: b8 00 00 00 00 00 00 00  40 00 00 00 00 00 00 00   ........@.......
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 80 00 00 00   ................
::::: 0e 1f ba 0e 00 b4 09 cd  21 b8 01 4c cd 21 54 68   ........!..L.!Th
::::: 69 73 20 70 72 6f 67 72  61 6d 20 63 61 6e 6e 6f   is program canno
::::: 74 20 62 65 20 72 75 6e  20 69 6e 20 44 4f 53 20   t be run in DOS 
::::: 6d 6f 64 65 2e 0d 0d 0a  24 00 00 00 00 00 00 00   mode....$.......
::::: 50 45 00 00 4c 01 02 00  00 00 00 00 00 00 00 00   PE..L...........
::::: 00 00 00 00 e0 00 0f 03  0b 01 06 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  d7 1d 00 00 00 10 00 00   ................
::::: 00 20 00 00 00 00 40 00  00 10 00 00 00 02 00 00   . ....@.........
::::: 04 00 00 00 00 00 00 00  04 00 00 00 00 00 00 00   ................
::::: 00 30 00 00 00 02 00 00  e7 15 01 00 03 00 00 00   .0..............
::::: 00 00 10 00 00 10 00 00  00 00 10 00 00 10 00 00   ................
::::: 00 00 00 00 10 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 70 20 00 00 64 00 00 00  00 00 00 00 00 00 00 00   p ..d...........
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  d4 20 00 00 80 00 00 00   ......... ......
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  2e 74 65 78 74 00 00 00   .........text...
::::: 28 0f 00 00 00 10 00 00  00 10 00 00 00 02 00 00   (...............
::::: 00 00 00 00 00 00 00 00  00 00 00 00 20 00 00 60   ............ ..`
::::: 2e 64 61 74 61 00 00 00  90 04 00 00 00 20 00 00   .data........ ..
::::: 00 04 00 00 00 12 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 40 00 00 c0  00 00 00 00 00 00 00 00   ....@...........
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 55 89 e5 81 ec 00 00 00  00 90 b8 03 00 00 00 8b   U...............
::::: 0d 80 24 40 00 39 c8 0f  85 1b 00 00 00 8b 05 84   ..$@.9..........
::::: 24 40 00 83 c0 08 8b 08  89 0d c4 23 40 00 e8 ea   $@.........#@...
::::: 09 00 00 e9 e3 00 00 00  b8 04 00 00 00 8b 0d 80   ................
::::: 24 40 00 39 c8 0f 8f d0  00 00 00 b8 02 00 00 00   $@.9............
::::: 89 05 00 24 40 00 8b 05  80 24 40 00 48 89 05 04   ...$@....$@.H...
::::: 24 40 00 b8 e8 23 40 00  50 8b 05 e0 23 40 00 50   $@...#@.P...#@.P
::::: e8 db 0d 00 00 8b 05 00  24 40 00 8b 0d 04 24 40   ........$@....$@
::::: 00 39 c8 0f 8d 7e 00 00  00 8b 05 00 24 40 00 89   .9...~......$@..
::::: c1 40 89 05 00 24 40 00  c1 e1 02 8b 05 84 24 40   .@...$@.......$@
::::: 00 01 c8 b9 10 00 00 00  51 b9 00 00 00 00 51 8b   ........Q.....Q.
::::: 08 51 e8 a1 0d 00 00 83  c4 0c 81 e0 ff ff 00 00   .Q..............
::::: 66 89 05 c0 23 40 00 8b  05 00 24 40 00 89 c1 40   f...#@....$@...@
::::: 89 05 00 24 40 00 c1 e1  02 8b 05 84 24 40 00 01   ...$@.......$@..
::::: c8 8b 08 89 0d c4 23 40  00 0f b7 05 c0 23 40 00   ......#@.....#@.
::::: 50 8b 05 e0 23 40 00 50  e8 63 0d 00 00 e8 1b 09   P...#@.P.c......
::::: 00 00 e9 6e ff ff ff 0f  b7 05 f0 23 40 00 50 8b   ...n.......#@.P.
::::: 05 e0 23 40 00 50 e8 45  0d 00 00 c9 c3 55 89 e5   ..#@.P.E.....U..
::::: 81 ec 00 00 00 00 90 b8  04 00 00 00 8b 0d 80 24   ...............$
::::: 40 00 39 c8 0f 8f 48 01  00 00 b8 04 00 00 00 89   @.9...H.........
::::: 05 08 24 40 00 8b 05 80  24 40 00 48 89 05 0c 24   ..$@....$@.H...$
::::: 40 00 b8 e8 23 40 00 50  8b 05 e0 23 40 00 50 e8   @...#@.P...#@.P.
::::: ec 0c 00 00 b8 7f 1c 40  00 89 05 00 20 40 00 8b   .......@.... @..
::::: 05 84 24 40 00 83 c0 0c  b9 0a 00 00 00 51 b9 00   ..$@.........Q..
::::: 00 00 00 51 8b 08 51 e8  cc 0c 00 00 83 c4 0c c1   ...Q..Q.........
::::: e0 10 c1 f8 10 66 89 05  d6 23 40 00 8b 05 84 24   .....f...#@....$
::::: 40 00 83 c0 08 b9 0a 00  00 00 51 b9 00 00 00 00   @.........Q.....
::::: 51 8b 08 51 e8 9f 0c 00  00 83 c4 0c c1 e0 10 c1   Q..Q............
::::: f8 10 66 89 05 d8 23 40  00 0f bf 05 d6 23 40 00   ..f...#@.....#@.
::::: 66 89 05 c8 23 40 00 b8  01 00 00 00 66 89 05 ce   f...#@......f...
::::: 23 40 00 b8 01 00 00 00  66 89 05 d0 23 40 00 b8   #@......f...#@..
::::: 00 00 00 00 66 89 05 d2  23 40 00 b8 00 00 00 00   ....f...#@......
::::: 66 89 05 d4 23 40 00 8b  05 08 24 40 00 8b 0d 0c   f...#@....$@....
::::: 24 40 00 39 c8 0f 8d 67  00 00 00 8b 05 08 24 40   $@.9...g......$@
::::: 00 89 c1 40 89 05 08 24  40 00 c1 e1 02 8b 05 84   ...@...$@.......
::::: 24 40 00 01 c8 b9 10 00  00 00 51 b9 00 00 00 00   $@........Q.....
::::: 51 8b 08 51 e8 0f 0c 00  00 83 c4 0c 81 e0 ff ff   Q..Q............
::::: 00 00 66 89 05 cc 23 40  00 8b 05 08 24 40 00 89   ..f...#@....$@..
::::: c1 40 89 05 08 24 40 00  c1 e1 02 8b 05 84 24 40   .@...$@.......$@
::::: 00 01 c8 8b 08 89 0d c4  23 40 00 e8 9d 07 00 00   ........#@......
::::: eb 85 c9 c3 55 89 e5 81  ec 00 00 00 00 90 b8 04   ....U...........
::::: 00 00 00 8b 0d 80 24 40  00 39 c8 0f 85 83 00 00   ......$@.9......
::::: 00 8b 05 84 24 40 00 83  c0 0c b9 0a 00 00 00 51   ....$@.........Q
::::: b9 00 00 00 00 51 8b 08  51 e8 9a 0b 00 00 83 c4   .....Q..Q.......
::::: 0c c1 e0 10 c1 f8 10 66  89 05 10 24 40 00 8b 05   .......f...$@...
::::: 84 24 40 00 83 c0 08 b9  0a 00 00 00 51 b9 00 00   .$@.........Q...
::::: 00 00 51 8b 08 51 e8 6d  0b 00 00 83 c4 0c c1 e0   ..Q..Q.m........
::::: 10 c1 f8 10 66 89 05 12  24 40 00 81 ec 04 00 00   ....f...$@......
::::: 00 89 e0 b9 04 00 00 00  51 b9 10 24 40 00 51 50   ........Q..$@.QP
::::: e8 53 0b 00 00 83 c4 0c  8b 05 e0 23 40 00 50 e8   .S.........#@.P.
::::: 4c 0b 00 00 c9 c3 55 89  e5 81 ec 00 00 00 00 90   L.....U.........
::::: e8 43 0b 00 00 85 c0 0f  84 05 00 00 00 e8 02 00   .C..............
::::: 00 00 c9 c3 55 89 e5 81  ec 00 00 00 00 90 e8 2d   ....U..........-
::::: 0b 00 00 89 05 6c 20 40  00 8b 05 6c 20 40 00 85   .....l @...l @..
::::: c0 0f 84 18 00 00 00 b8  e0 00 00 00 8b 0d 6c 20   ..............l 
::::: 40 00 39 c8 0f 84 05 00  00 00 e9 11 00 00 00 e8   @.9.............
::::: fc 0a 00 00 81 c0 ff 00  00 00 89 05 6c 20 40 00   ............l @.
::::: c9 c3 55 89 e5 81 ec 00  00 00 00 90 b8 f6 ff ff   ..U.............
::::: ff 50 e8 e1 0a 00 00 89  05 e4 23 40 00 b8 14 24   .P........#@...$
::::: 40 00 50 8b 05 e4 23 40  00 50 e8 d1 0a 00 00 8b   @.P...#@.P......
::::: 05 14 24 40 00 83 c8 10  83 e0 bf 83 e0 fe 89 05   ..$@............
::::: 18 24 40 00 8b 05 18 24  40 00 50 8b 05 e4 23 40   .$@....$@.P...#@
::::: 00 50 e8 b1 0a 00 00 b8  1c 24 40 00 50 b8 01 00   .P.......$@.P...
::::: 00 00 50 b8 20 24 40 00  50 8b 05 e4 23 40 00 50   ..P. $@.P...#@.P
::::: e8 9b 0a 00 00 b8 02 00  00 00 0f b7 0d 20 24 40   ............. $@
::::: 00 39 c8 0f 85 42 00 00  00 8b 05 28 24 40 00 89   .9...B.....($@..
::::: 05 34 24 40 00 b8 01 00  00 00 8b 0d 34 24 40 00   .4$@........4$@.
::::: 39 c8 0f 85 23 00 00 00  0f bf 05 24 24 40 00 50   9...#......$$@.P
::::: 0f bf 05 26 24 40 00 50  b8 04 20 40 00 50 e8 55   ...&$@.P.. @.P.U
::::: 0a 00 00 83 c4 0c e9 02  00 00 00 eb 8a 8b 05 14   ................
::::: 24 40 00 50 8b 05 e4 23  40 00 50 e8 28 0a 00 00   $@.P...#@.P.(...
::::: c9 c3 55 89 e5 81 ec 00  00 00 00 90 b8 38 24 40   ..U..........8$@
::::: 00 50 e8 29 0a 00 00 0f  b7 05 46 24 40 00 50 0f   .P.)......F$@.P.
::::: b7 05 44 24 40 00 50 0f  b7 05 42 24 40 00 50 0f   ..D$@.P...B$@.P.
::::: b7 05 40 24 40 00 50 0f  b7 05 3c 24 40 00 50 0f   ..@$@.P...<$@.P.
::::: b7 05 3e 24 40 00 50 0f  b7 05 3a 24 40 00 50 0f   ..>$@.P...:$@.P.
::::: b7 05 38 24 40 00 50 b8  0a 20 40 00 50 e8 d6 09   ..8$@.P.. @.P...
::::: 00 00 83 c4 24 c9 c3 55  89 e5 81 ec 00 00 00 00   ....$..U........
::::: 90 b8 03 00 00 00 8b 0d  80 24 40 00 39 c8 0f 85   .........$@.9...
::::: 26 00 00 00 8b 05 84 24  40 00 83 c0 08 b9 0a 00   &......$@.......
::::: 00 00 51 b9 00 00 00 00  51 8b 08 51 e8 47 09 00   ..Q.....Q..Q.G..
::::: 00 83 c4 0c 50 e8 9e 09  00 00 c9 c3 55 89 e5 81   ....P.......U...
::::: ec 00 00 00 00 90 b8 03  00 00 00 8b 0d 80 24 40   ..............$@
::::: 00 39 c8 0f 85 d7 00 00  00 b8 48 24 40 00 50 8b   .9........H$@.P.
::::: 05 e0 23 40 00 50 e8 75  09 00 00 8b 05 84 24 40   ..#@.P.u......$@
::::: 00 83 c0 08 b9 0a 00 00  00 51 b9 00 00 00 00 51   .........Q.....Q
::::: 8b 08 51 e8 f0 08 00 00  83 c4 0c 89 05 50 24 40   ..Q..........P$@
::::: 00 8b 05 50 24 40 00 e9  05 00 00 00 e9 09 00 00   ...P$@..........
::::: 00 83 f8 00 0f 85 15 00  00 00 b8 00 00 00 00 89   ................
::::: 05 4c 24 40 00 e9 64 00  00 00 e9 09 00 00 00 83   .L$@..d.........
::::: f8 01 0f 85 15 00 00 00  b8 01 00 00 00 89 05 4c   ...............L
::::: 24 40 00 e9 46 00 00 00  e9 09 00 00 00 83 f8 19   $@..F...........
::::: 0f 85 05 00 00 00 e9 09  00 00 00 83 f8 32 0f 85   .............2..
::::: 05 00 00 00 e9 09 00 00  00 83 f8 64 0f 85 1c 00   ...........d....
::::: 00 00 b8 01 00 00 00 89  05 4c 24 40 00 8b 05 50   .........L$@...P
::::: 24 40 00 89 05 48 24 40  00 e9 00 00 00 00 b8 48   $@...H$@.......H
::::: 24 40 00 50 8b 05 e0 23  40 00 50 e8 b8 08 00 00   $@.P...#@.P.....
::::: c9 c3 55 89 e5 81 ec 00  00 00 00 90 b8 03 00 00   ..U.............
::::: 00 8b 0d 80 24 40 00 39  c8 0f 85 33 00 00 00 8b   ....$@.9...3....
::::: 05 84 24 40 00 83 c0 08  b9 0a 00 00 00 51 b9 00   ..$@.........Q..
::::: 00 00 00 51 8b 08 51 e8  0c 08 00 00 83 c4 0c 81   ...Q..Q.........
::::: e0 ff 00 00 00 50 8b 05  e0 23 40 00 50 e8 6e 08   .....P...#@.P.n.
::::: 00 00 c9 c3 55 89 e5 81  ec 00 00 00 00 90 b8 03   ....U...........
::::: 00 00 00 8b 0d 80 24 40  00 39 c8 0f 8f a6 00 00   ......$@.9......
::::: 00 b8 01 00 00 00 89 05  54 24 40 00 b8 12 00 02   ........T$@.....
::::: 00 89 05 58 24 40 00 b8  04 00 00 00 8b 0d 80 24   ...X$@.........$
::::: 40 00 39 c8 0f 8f 40 00  00 00 8b 05 84 24 40 00   @.9...@......$@.
::::: 83 c0 0c b9 0a 00 00 00  51 b9 00 00 00 00 51 8b   ........Q.....Q.
::::: 08 51 e8 91 07 00 00 83  c4 0c 89 05 54 24 40 00   .Q..........T$@.
::::: 8b 05 54 24 40 00 83 f8  00 0f 8d 0b 00 00 00 b8   ..T$@...........
::::: 00 00 00 00 89 05 54 24  40 00 8b 05 54 24 40 00   ......T$@...T$@.
::::: 85 c0 0f 84 2f 00 00 00  8b 05 84 24 40 00 83 c0   ..../......$@...
::::: 08 8b 0d 58 24 40 00 51  b9 00 00 00 00 51 8b 08   ...X$@.Q.....Q..
::::: 51 e8 c2 07 00 00 8b 05  54 24 40 00 83 c0 ff 89   Q.......T$@.....
::::: 05 54 24 40 00 eb c3 c9  c3 55 89 e5 81 ec 00 00   .T$@.....U......
::::: 00 00 90 b8 01 00 00 00  8b 0d 80 24 40 00 39 c8   ...........$@.9.
::::: 0f 8d d5 02 00 00 8b 05  84 24 40 00 83 c0 04 8b   .........$@.....
::::: 08 89 0d 60 24 40 00 8b  05 60 24 40 00 89 05 64   ...`$@...`$@...d
::::: 24 40 00 8b 05 64 24 40  00 0f be 08 85 c9 0f 84   $@...d$@........
::::: 1d 00 00 00 8b 05 64 24  40 00 0f be 08 83 e1 5f   ......d$@......_
::::: 88 08 8b 05 64 24 40 00  40 89 05 64 24 40 00 eb   ....d$@.@..d$@..
::::: d2 b8 22 20 40 00 50 8b  05 60 24 40 00 50 e8 3d   .." @.P..`$@.P.=
::::: 07 00 00 83 c4 08 85 c0  0f 84 05 00 00 00 e9 10   ................
::::: 00 00 00 b8 00 10 40 00  89 05 5c 24 40 00 e9 31   ......@...\$@..1
::::: 02 00 00 b8 28 20 40 00  50 8b 05 60 24 40 00 50   ....( @.P..`$@.P
::::: e8 0b 07 00 00 83 c4 08  85 c0 0f 84 05 00 00 00   ................
::::: e9 10 00 00 00 b8 1d 11  40 00 89 05 5c 24 40 00   ........@...\$@.
::::: e9 ff 01 00 00 b8 2f 20  40 00 50 8b 05 60 24 40   ....../ @.P..`$@
::::: 00 50 e8 d9 06 00 00 83  c4 08 85 c0 0f 84 05 00   .P..............
::::: 00 00 e9 10 00 00 00 b8  84 12 40 00 89 05 5c 24   ..........@...\$
::::: 40 00 e9 cd 01 00 00 b8  36 20 40 00 50 8b 05 60   @.......6 @.P..`
::::: 24 40 00 50 e8 a7 06 00  00 83 c4 08 85 c0 0f 84   $@.P............
::::: 05 00 00 00 e9 10 00 00  00 b8 26 13 40 00 89 05   ..........&.@...
::::: 5c 24 40 00 e9 9b 01 00  00 b8 3b 20 40 00 50 8b   \$@.......; @.P.
::::: 05 60 24 40 00 50 e8 75  06 00 00 83 c4 08 85 c0   .`$@.P.u........
::::: 0f 84 05 00 00 00 e9 10  00 00 00 b8 44 13 40 00   ............D.@.
::::: 89 05 5c 24 40 00 e9 69  01 00 00 b8 3f 20 40 00   ..\$@..i....? @.
::::: 50 8b 05 60 24 40 00 50  e8 43 06 00 00 83 c4 08   P..`$@.P.C......
::::: 85 c0 0f 84 05 00 00 00  e9 10 00 00 00 b8 92 13   ................
::::: 40 00 89 05 5c 24 40 00  e9 37 01 00 00 b8 45 20   @...\$@..7....E 
::::: 40 00 50 8b 05 60 24 40  00 50 e8 11 06 00 00 83   @.P..`$@.P......
::::: c4 08 85 c0 0f 84 05 00  00 00 e9 10 00 00 00 b8   ................
::::: 72 14 40 00 89 05 5c 24  40 00 e9 05 01 00 00 b8   r.@...\$@.......
::::: 4a 20 40 00 50 8b 05 60  24 40 00 50 e8 df 05 00   J @.P..`$@.P....
::::: 00 83 c4 08 85 c0 0f 84  05 00 00 00 e9 10 00 00   ................
::::: 00 b8 d7 14 40 00 89 05  5c 24 40 00 e9 d3 00 00   ....@...\$@.....
::::: 00 b8 50 20 40 00 50 8b  05 60 24 40 00 50 e8 ad   ..P @.P..`$@.P..
::::: 05 00 00 83 c4 08 85 c0  0f 84 05 00 00 00 e9 10   ................
::::: 00 00 00 b8 1c 15 40 00  89 05 5c 24 40 00 e9 a1   ......@...\$@...
::::: 00 00 00 b8 57 20 40 00  50 8b 05 60 24 40 00 50   ....W @.P..`$@.P
::::: e8 7b 05 00 00 83 c4 08  85 c0 0f 84 05 00 00 00   .{..............
::::: e9 10 00 00 00 b8 12 16  40 00 89 05 5c 24 40 00   ........@...\$@.
::::: e9 6f 00 00 00 b8 5c 20  40 00 50 8b 05 60 24 40   .o....\ @.P..`$@
::::: 00 50 e8 49 05 00 00 83  c4 08 85 c0 0f 84 05 00   .P.I............
::::: 00 00 e9 10 00 00 00 b8  64 16 40 00 89 05 5c 24   ........d.@...\$
::::: 40 00 e9 3d 00 00 00 b8  61 20 40 00 50 8b 05 60   @..=....a @.P..`
::::: 24 40 00 50 e8 17 05 00  00 83 c4 08 85 c0 0f 84   $@.P............
::::: 05 00 00 00 e9 10 00 00  00 b8 9b 1d 40 00 89 05   ............@...
::::: 5c 24 40 00 e9 0b 00 00  00 b8 00 00 00 00 89 05   \$@.............
::::: 5c 24 40 00 8b 05 5c 24  40 00 85 c0 0f 84 19 00   \$@...\$@.......
::::: 00 00 b8 f5 ff ff ff 50  e8 7b 04 00 00 89 05 e0   .......P.{......
::::: 23 40 00 8b 05 5c 24 40  00 ff d0 c9 c3 55 89 e5   #@...\$@.....U..
::::: 81 ec 00 00 00 00 90 b8  00 00 00 00 89 05 68 24   ..............h$
::::: 40 00 b8 00 00 00 00 89  05 6c 24 40 00 b8 00 00   @........l$@....
::::: 00 00 89 05 70 24 40 00  8b 05 c4 23 40 00 89 05   ....p$@....#@...
::::: 78 24 40 00 8b 05 78 24  40 00 0f be 08 89 0d 74   x$@...x$@......t
::::: 24 40 00 85 c9 0f 84 f2  01 00 00 8b 05 70 24 40   $@...........p$@
::::: 00 85 c0 0f 84 05 00 00  00 e9 3f 00 00 00 b8 5c   ..........?....\
::::: 00 00 00 8b 0d 74 24 40  00 39 c8 b8 00 00 00 00   .....t$@.9......
::::: 0f 94 c0 89 05 70 24 40  00 85 c0 0f 84 05 00 00   .....p$@........
::::: 00 e9 12 00 00 00 8b 05  74 24 40 00 50 8b 05 00   ........t$@.P...
::::: 20 40 00 ff d0 83 c4 04  e9 8e 01 00 00 8b 05 74    @.............t
::::: 24 40 00 50 e8 1f 04 00  00 83 c4 04 85 c0 0f 84   $@.P............
::::: b6 00 00 00 8b 05 6c 24  40 00 83 f8 02 0f 8d 67   ......l$@......g
::::: 00 00 00 8b 05 6c 24 40  00 40 89 05 6c 24 40 00   .....l$@.@..l$@.
::::: 8b 05 68 24 40 00 c1 e0  04 89 05 68 24 40 00 8b   ..h$@......h$@..
::::: 05 74 24 40 00 83 f8 39  b8 00 00 00 00 0f 9e c0   .t$@...9........
::::: 85 c0 0f 84 0e 00 00 00  8b 05 74 24 40 00 83 e8   ..........t$@...
::::: 30 e9 11 00 00 00 8b 05  74 24 40 00 83 c8 20 83   0.......t$@... .
::::: e8 57 e9 00 00 00 00 8b  0d 68 24 40 00 01 c1 89   .W.......h$@....
::::: 0d 68 24 40 00 e9 3b 00  00 00 8b 05 68 24 40 00   .h$@..;.....h$@.
::::: 50 8b 05 00 20 40 00 ff  d0 83 c4 04 8b 05 74 24   P... @........t$
::::: 40 00 50 8b 05 00 20 40  00 ff d0 83 c4 04 b8 00   @.P... @........
::::: 00 00 00 89 05 68 24 40  00 89 05 6c 24 40 00 89   .....h$@...l$@..
::::: 05 70 24 40 00 e9 c1 00  00 00 8b 05 6c 24 40 00   .p$@........l$@.
::::: 85 c0 0f 84 62 00 00 00  8b 05 68 24 40 00 50 8b   ....b.....h$@.P.
::::: 05 00 20 40 00 ff d0 83  c4 04 b8 5c 00 00 00 8b   .. @.......\....
::::: 0d 74 24 40 00 39 c8 b8  00 00 00 00 0f 94 c0 89   .t$@.9..........
::::: 05 70 24 40 00 85 c0 0f  84 05 00 00 00 e9 12 00   .p$@............
::::: 00 00 8b 05 74 24 40 00  50 8b 05 00 20 40 00 ff   ....t$@.P... @..
::::: d0 83 c4 04 b8 00 00 00  00 89 05 68 24 40 00 89   ...........h$@..
::::: 05 6c 24 40 00 e9 51 00  00 00 8b 05 74 24 40 00   .l$@..Q.....t$@.
::::: e9 05 00 00 00 e9 09 00  00 00 83 f8 6e 0f 85 16   ............n...
::::: 00 00 00 b8 0a 00 00 00  50 8b 05 00 20 40 00 ff   ........P... @..
::::: d0 83 c4 04 e9 17 00 00  00 8b 05 74 24 40 00 50   ...........t$@.P
::::: 8b 05 00 20 40 00 ff d0  83 c4 04 e9 00 00 00 00   ... @...........
::::: b8 00 00 00 00 89 05 70  24 40 00 8b 05 78 24 40   .......p$@...x$@
::::: 00 40 89 05 78 24 40 00  e9 f7 fd ff ff 8b 05 6c   .@..x$@........l
::::: 24 40 00 85 c0 0f 84 12  00 00 00 8b 05 68 24 40   $@...........h$@
::::: 00 50 8b 05 00 20 40 00  ff d0 83 c4 04 c9 c3 55   .P... @........U
::::: 89 e5 81 ec 00 00 00 00  90 8b 45 08 e9 05 00 00   ..........E.....
::::: 00 e9 09 00 00 00 83 f8  00 0f 85 19 00 00 00 0f   ................
::::: bf 05 d6 23 40 00 40 66  89 05 d6 23 40 00 e9 de   ...#@.@f...#@...
::::: 00 00 00 e9 09 00 00 00  83 f8 0a 0f 85 22 00 00   ............."..
::::: 00 0f bf 05 d8 23 40 00  40 66 89 05 d8 23 40 00   .....#@.@f...#@.
::::: 0f bf 05 c8 23 40 00 66  89 05 d6 23 40 00 e9 ae   ....#@.f...#@...
::::: 00 00 00 0f bf 05 d6 23  40 00 83 f8 00 0f 8c 8a   .......#@.......
::::: 00 00 00 0f bf 05 d8 23  40 00 83 f8 00 0f 8c 7a   .......#@......z
::::: 00 00 00 0f be 45 08 88  05 ca 23 40 00 0f bf 05   .....E....#@....
::::: d6 23 40 00 40 66 89 05  da 23 40 00 0f bf 05 d8   .#@.@f...#@.....
::::: 23 40 00 40 66 89 05 dc  23 40 00 b8 d6 23 40 00   #@.@f...#@...#@.
::::: 50 81 ec 04 00 00 00 89  e0 b9 04 00 00 00 51 b9   P.............Q.
::::: d2 23 40 00 51 50 e8 1d  01 00 00 83 c4 0c 81 ec   .#@.QP..........
::::: 04 00 00 00 89 e0 b9 04  00 00 00 51 b9 ce 23 40   ...........Q..#@
::::: 00 51 50 e8 00 01 00 00  83 c4 0c b8 ca 23 40 00   .QP..........#@.
::::: 50 8b 05 e0 23 40 00 50  e8 73 01 00 00 0f bf 05   P...#@.P.s......
::::: d6 23 40 00 40 66 89 05  d6 23 40 00 e9 00 00 00   .#@.@f...#@.....
::::: 00 8b 45 08 e9 00 00 00  00 c9 c3 55 89 e5 81 ec   ..E........U....
::::: 00 00 00 00 90 e8 4e 01  00 00 89 05 7c 24 40 00   ......N.....|$@.
::::: b8 00 00 00 00 8b 0d 7c  24 40 00 39 c8 0f 84 12   .......|$@.9....
::::: 00 00 00 b8 03 00 00 00  50 8b 05 7c 24 40 00 50   ........P..|$@.P
::::: e8 2b 01 00 00 c9 c3 55  89 e5 81 ec 04 00 00 00   .+.....U........
::::: 90 b8 00 00 00 00 89 45  fc 8d 45 fc 50 b8 00 00   .......E..E.P...
::::: 00 00 50 b8 88 24 40 00  50 b8 84 24 40 00 50 b8   ..P..$@.P..$@.P.
::::: 80 24 40 00 50 e8 fe 00  00 00 83 c4 14 e8 fe 00   .$@.P...........
::::: 00 00 89 05 8c 24 40 00  b8 e4 04 00 00 50 e8 f5   .....$@......P..
::::: 00 00 00 e8 01 f9 ff ff  8b 05 8c 24 40 00 50 e8   ...........$@.P.
::::: e4 00 00 00 8b 05 6c 20  40 00 50 e8 e0 00 00 00   ......l @.P.....
::::: 83 c4 04 c9 c3 00 00 00  ff 25 d4 20 40 00 00 00   .........%. @...
::::: ff 25 00 21 40 00 00 00  ff 25 d8 20 40 00 00 00   .%.!@....%. @...
::::: ff 25 04 21 40 00 00 00  ff 25 dc 20 40 00 00 00   .%.!@....%. @...
::::: ff 25 08 21 40 00 00 00  ff 25 e0 20 40 00 00 00   .%.!@....%. @...
::::: ff 25 e4 20 40 00 00 00  ff 25 0c 21 40 00 00 00   .%. @....%.!@...
::::: ff 25 10 21 40 00 00 00  ff 25 14 21 40 00 00 00   .%.!@....%.!@...
::::: ff 25 18 21 40 00 00 00  ff 25 e8 20 40 00 00 00   .%.!@....%. @...
::::: ff 25 1c 21 40 00 00 00  ff 25 20 21 40 00 00 00   .%.!@....% !@...
::::: ff 25 24 21 40 00 00 00  ff 25 28 21 40 00 00 00   .%$!@....%(!@...
::::: ff 25 2c 21 40 00 00 00  ff 25 44 21 40 00 00 00   .%,!@....%D!@...
::::: ff 25 ec 20 40 00 00 00  ff 25 f0 20 40 00 00 00   .%. @....%. @...
::::: ff 25 30 21 40 00 00 00  ff 25 34 21 40 00 00 00   .%0!@....%4!@...
::::: ff 25 4c 21 40 00 00 00  ff 25 f4 20 40 00 00 00   .%L!@....%. @...
::::: ff 25 38 21 40 00 00 00  ff 25 3c 21 40 00 00 00   .%8!@....%<!@...
::::: ff 25 f8 20 40 00 00 00  00 00 00 00 00 00 00 00   .%. @...........
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 48 1e 40 00 25 64 20 25  64 00 25 64 20 25 64 20   H.@.%d %d.%d %d 
::::: 25 64 20 25 64 20 25 64  20 25 64 20 25 64 20 25   %d %d %d %d %d %
::::: 64 00 50 52 49 4e 54 00  53 50 52 49 54 45 00 4c   d.PRINT.SPRITE.L
::::: 4f 43 41 54 45 00 5f 4b  42 44 00 4b 42 44 00 4d   OCATE._KBD.KBD.M
::::: 4f 55 53 45 00 54 49 4d  45 00 53 4c 45 %screen_h% 50 00   OUSE.TIME.SLEEP.
::::: 43 55 52 53 4f 52 00 46  4f 4e 54 00 50 4c 41 59   CURSOR.FONT.PLAY
::::: 00 4d 41 58 49 4d 49 5a  45 00 00 00 00 00 00 00   .MAXIMIZE.......
::::: 54 21 00 00 00 00 00 00  00 00 00 00 d4 21 00 00   T!...........!..
::::: d4 20 00 00 80 21 00 00  00 00 00 00 00 00 00 00   . ...!..........
::::: 42 22 00 00 00 21 00 00  c4 21 00 00 00 00 00 00   B"...!...!......
::::: 00 00 00 00 8f 23 00 00  44 21 00 00 cc 21 00 00   .....#..D!...!..
::::: 00 00 00 00 00 00 00 00  a6 23 00 00 4c 21 00 00   .........#..L!..
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 df 21 00 00  e9 21 00 00 f3 21 00 00   .....!...!...!..
::::: fc 21 00 00 05 22 00 00  0e 22 00 00 17 22 00 00   .!..."..."..."..
::::: 20 22 00 00 2b 22 00 00  3b 22 00 00 00 00 00 00    "..+"..;"......
::::: 4f 22 00 00 6c 22 00 00  86 22 00 00 a1 22 00 00   O"..l"..."..."..
::::: b0 22 00 00 c1 22 00 00  d2 22 00 00 e6 22 00 00   ."..."..."..."..
::::: f5 22 00 00 fd 22 00 00  14 23 00 00 2b 23 00 00   ."..."...#..+#..
::::: 3c 23 00 00 52 23 00 00  65 23 00 00 7a 23 00 00   <#..R#..e#..z#..
::::: 00 00 00 00 99 23 00 00  00 00 00 00 b1 23 00 00   .....#.......#..
::::: 00 00 00 00 df 21 00 00  e9 21 00 00 f3 21 00 00   .....!...!...!..
::::: fc 21 00 00 05 22 00 00  0e 22 00 00 17 22 00 00   .!..."..."..."..
::::: 20 22 00 00 2b 22 00 00  3b 22 00 00 00 00 00 00    "..+"..;"......
::::: 4f 22 00 00 6c 22 00 00  86 22 00 00 a1 22 00 00   O"..l"..."..."..
::::: b0 22 00 00 c1 22 00 00  d2 22 00 00 e6 22 00 00   ."..."..."..."..
::::: f5 22 00 00 fd 22 00 00  14 23 00 00 2b 23 00 00   ."..."...#..+#..
::::: 3c 23 00 00 52 23 00 00  65 23 00 00 7a 23 00 00   <#..R#..e#..z#..
::::: 00 00 00 00 99 23 00 00  00 00 00 00 b1 23 00 00   .....#.......#..
::::: 00 00 00 00 6d 73 76 63  72 74 2e 64 6c 6c 00 00   ....msvcrt.dll..
::::: 00 70 75 74 63 68 61 72  00 00 00 73 74 72 74 6f   .putchar...strto
::::: 75 6c 00 00 00 6d 65 6d  63 70 79 00 00 00 5f 6b   ul...memcpy..._k
::::: 62 68 69 74 00 00 00 5f  67 65 74 63 68 00 00 00   bhit..._getch...
::::: 70 72 69 6e 74 66 00 00  00 73 74 72 63 6d 70 00   printf...strcmp.
::::: 00 00 69 73 78 64 69 67  69 74 00 00 00 5f 5f 67   ..isxdigit...__g
::::: 65 74 6d 61 69 6e 61 72  67 73 00 00 00 65 78 69   etmainargs...exi
::::: 74 00 6b 65 72 6e 65 6c  33 32 2e 64 6c 6c 00 00   t.kernel32.dll..
::::: 00 47 65 74 43 6f 6e 73  6f 6c 65 53 63 72 65 65   .GetConsoleScree
::::: 6e 42 75 66 66 65 72 49  6e 66 6f 00 00 00 53 65   nBufferInfo...Se
::::: 74 43 6f 6e 73 6f 6c 65  54 65 78 74 41 74 74 72   tConsoleTextAttr
::::: 69 62 75 74 65 00 00 00  53 65 74 43 6f 6e 73 6f   ibute...SetConso
::::: 6c 65 43 75 72 73 6f 72  50 6f 73 69 74 69 6f 6e   leCursorPosition
::::: 00 00 00 47 65 74 53 74  64 48 61 6e 64 6c 65 00   ...GetStdHandle.
::::: 00 00 47 65 74 43 6f 6e  73 6f 6c 65 4d 6f 64 65   ..GetConsoleMode
::::: 00 00 00 53 65 74 43 6f  6e 73 6f 6c 65 4d 6f 64   ...SetConsoleMod
::::: 65 00 00 00 52 65 61 64  43 6f 6e 73 6f 6c 65 49   e...ReadConsoleI
::::: 6e 70 75 74 41 00 00 00  47 65 74 4c 6f 63 61 6c   nputA...GetLocal
::::: 54 69 6d 65 00 00 00 53  6c 65 65 70 00 00 00 47   Time...Sleep...G
::::: 65 74 43 6f 6e 73 6f 6c  65 43 75 72 73 6f 72 49   etConsoleCursorI
::::: 6e 66 6f 00 00 00 53 65  74 43 6f 6e 73 6f 6c 65   nfo...SetConsole
::::: 43 75 72 73 6f 72 49 6e  66 6f 00 00 00 53 65 74   CursorInfo...Set
::::: 43 6f 6e 73 6f 6c 65 46  6f 6e 74 00 00 00 57 72   ConsoleFont...Wr
::::: 69 74 65 43 6f 6e 73 6f  6c 65 4f 75 74 70 75 74   iteConsoleOutput
::::: 41 00 00 00 47 65 74 43  6f 6e 73 6f 6c 65 57 69   A...GetConsoleWi
::::: 6e 64 6f 77 00 00 00 47  65 74 43 6f 6e 73 6f 6c   ndow...GetConsol
::::: 65 4f 75 74 70 75 74 43  50 00 00 00 53 65 74 43   eOutputCP...SetC
::::: 6f 6e 73 6f 6c 65 4f 75  74 70 75 74 43 50 00 77   onsoleOutputCP.w
::::: 69 6e 6d 6d 2e 64 6c 6c  00 00 00 50 6c 61 79 53   inmm.dll...PlayS
::::: 6f 75 6e 64 41 00 75 73  65 72 33 32 2e 64 6c 6c   oundA.user32.dll
::::: 00 00 00 53 68 6f 77 57  69 6e 64 6f 77 00 00 00   ...ShowWindow...
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
::::: 00 00 00 00 00 00 00 00  00 00 00 00 00 00 00 00   ................
>hex.temp (
	for /f "delims=: tokens=*" %%A in ('findstr "^:::::" "%~f0"') do echo %%A
)

certutil -f -decodeHex hex.temp bin_os\bg.exe >nul
if not exist "%SystemRoot%\System32\bg.exe" copy bin_os\bg.exe "%SystemRoot%\System32" /Y >nul
del hex.temp
goto :eof

:hibercheck
if "%hibernated%"=="true" (
if "%hibernotify%"=="true" (
echo.&echo. Would you like to restore the session?&echo.
echo. The last session of Log OS was saved. Would you like to restore or&echo. delete it?
echo.&echo. 1. Resume&echo.    Everything will be restored&echo.&echo. 2. Erase&echo.    Hibernation data will be erased&echo.
set /p select=Your selection:
if "!select!"=="2" goto hiberrestart
if not "!select!"=="1" goto reask
)
)
if "%hibernated%"=="true" mode %screen_w%,%screen_h%
if "%hibernated%"=="true" color 08
for /l %%a in (1 1 %blank_h%) do (
Echo.%blankspace%               
)
if "%hibernated%"=="true" Echo.%blankspace%³    
if "%hibernated%"=="true" Echo.%blankspace%³    
if "%hibernated%"=="true" Echo.%blankspace%³ù    
if "%hibernated%"=="true" Echo.%blankspace%³ùù   
if "%hibernated%"=="true" Echo.%blankspace%ÀÄÄÄÄÄ
if "%hibernated%"=="true" Echo.
if "%hibernated%"=="true" Echo.%minispace% Resuming LogOS...
if "%hibernated%"=="true" ping localhost -n 1 >nul
if "%hibernated%"=="true" color 07
if "%hibernated%"=="true" ping localhost -n 1 >nul
if "%hibernated%"=="true" color 0f
if "%hibernated%"=="true" ping localhost -n 1 >nul&color %rndcolor%&call :lastsession&goto lastfade
goto :eof

:normalstuffs
wmic process where name="cmd.exe" CALL setpriority "realtime" >nul
wmic process where name="conhost.exe" CALL setpriority "high priority" >nul
if "%fi%"=="yes" goto fi
color 07
ping localhost -n 1 >nul
color 08
ping localhost -n 1 >nul
cls
bg font 6
cls
bg print 08 "Loading Log OS kernel..."
ping localhost -n 1 >nul
color 07
ping localhost -n 1 >nul
color 0F
ping localhost -n 1 >nul
set debug=false
if "%1"=="setup" color EF&echo External command&ping localhost -n 2 >nul&goto tempset
if "%1"=="ver" color EF&echo External command&ping localhost -n 2 >nul&goto passit
if "%1"=="update" color EF&echo External command&ping localhost -n 2 >nul&set destination=%2&goto flashit
if "%1"=="safe" color EF&echo External command&ping localhost -n 2 >nul&set console=true
goto :eof

:prepare_bootmenu
set /a entries=0
for /f "eol=: delims=," %%a in (boot_os\boot_config.settings) do (
	set temp=%%a
	if not "!temp:~0,1!"=="*" (
		if not "!temp!"=="-END-" (
			if "!entries!"=="0" set "%%a"
			if not "!entries!"=="0" set "e!entries!_%%a"
		)
	) else (
		set /a entries+=1
	)
)
if "!entries!"=="1" set /a sel=1&goto boot_sel
if "!entries!"=="0" goto internal_start
goto boot_menu

:boot_menu
title Boot menu
color %rndcolor%
cls
echo.
echo Log O/S boot manager 1.0
echo Please select the operating environment you'd like to start
echo.
if "%rndcolor%"=="" set rndcolor=07
if "%hicolor%"=="" set rndcolor=70
if "%default%"=="" set default=1
if "%timeout%"=="" set timeout=10
if "%timer%"=="" set timer=yes
set /a sel=%default%
set /a timeout=!timeout!*250
:boot_menu_loop
if "!display_on_restart!"=="no" (
	if exist log_os\lgr (
		if exist log_os\Shutdown (
			goto boot_sel
		)
	)
)
bg locate 4 0
set /a bottom=!entries!+2+4
for /l %%a in (1 1 !entries!) do (
	set /a entrylocate=4+%%a
	bg locate !entrylocate! 0
	if "!sel!"=="%%a" bg print %hicolor% "                                                     "
	bg locate !entrylocate! 0
	if "!sel!"=="%%a" bg print %hicolor% " > !e%%a_name!\n"
	if not "!sel!"=="%%a" bg print %rndcolor% "                                                     "
	bg locate !entrylocate! 0
	if not "!sel!"=="%%a" bg print %rndcolor% "   !e%%a_name!\n"&bg locate !entrylocate! 0
)
:timerloop
if "!timer!"=="yes" (
if !timeout! GTR 0 (
bg locate !bottom! 0
set /a realsec=!timeout!/250
echo The selected option will start automatically in !realsec! seconds  
bg sleep 32
bin_os\bg.exe _kbd
set a=!ERRORLEVEL!
if not "!a!"=="0" set /a timeout=1&set timer=no
if "!a!"=="335" set /a sel+=1
if "!a!"=="334" goto :adv_sel
if "!a!"=="327" set /a sel-=1
if "!a!"=="13" goto :boot_sel
if not "!a!"=="0" goto boot_menu_loop
set /a timeout-=32
goto timerloop
) else (
goto boot_sel
)
)
if "!timer!"=="no" (
set "timer=no"
bg locate !bottom! 0
echo For advanced startup options press End                           
)
:boot_menu_prompt
if not exist bin_os\bg.exe goot boot_menu_panic
bin_os\bg.exe kbd
set a=%ERRORLEVEL%
if "%a%"=="335" set /a sel+=1
if "%a%"=="334" goto :adv_sel
if "%a%"=="327" set /a sel-=1
if "%a%"=="13" goto :boot_sel
set /a max=!entries!+1
if "!sel!"=="0" set sel=1
if "!sel!"=="!max!" set sel=!entries!
goto boot_menu_loop

:no_adv
cls
echo.
echo No advanced options available for !name!
echo.
pause
goto boot_menu

:adv_sel
cls
set "backupsel=!sel!"
set "safe="
set "recovery="
set "safe="
set "debug="
set name=!e%sel%_name!
set internal=!e%sel%_internal!
set safe=!e%sel%_safe!
set recovery=!e%sel%_recovery!
set normal=!e%sel%_normal!
set debug=!e%sel%_debug!
set /a count=6
if "!safe!"=="" set /a count-=1
if "!recovery!"=="" set /a count-=1
if "!debug!"=="" set /a count-=1
for /l %%a in (1 1 6) do set "item%%a="
set /a id=1
if not "!safe!"=="" set item%id%=Safe mode&set /a id+=1
if not "!recovery!"=="" set item%id%=Recovery mode&set /a id+=1
if not "!debug!"=="" set item%id%=Debug mode&set /a id+=1
set /a split=%id%-1
set item%id%=Start %name% normally&set /a id+=1
set item%id%=Restart system&set /a id+=1
set /a split2=%id%-1
set item%id%=Go back to boot options
if !count! LSS 4 goto no_adv
echo.
echo Advanced options for !name!
echo.
set /a sel=!count!-2
:adv_loop
set /a baseline=2
for /l %%a in (1 1 !count!) do (
set /a entrylocate=!baseline!+%%a
if "%%a"=="!split!" set /a baseline+=1
if "%%a"=="!split2!" set /a baseline+=1
bg locate !entrylocate! 0
if "!sel!"=="%%a" bg print %hicolor% "                                                     "
bg locate !entrylocate! 0
if "!sel!"=="%%a" bg print %hicolor% " > !item%%a!\n"
if not "!sel!"=="%%a" bg print %rndcolor% "                                                     "
bg locate !entrylocate! 0
if not "!sel!"=="%%a" bg print %rndcolor% "   !item%%a!\n"&bg locate !entrylocate! 0
)
:input_adv
if not exist bin_os\bg.exe goot boot_menu_panic
bin_os\bg.exe kbd
set a=%ERRORLEVEL%
if "%a%"=="335" set /a sel+=1
if "%a%"=="334" goto :adv_sel
if "%a%"=="327" set /a sel-=1
if "%a%"=="13" goto :adv_sel_sel
set /a max=!count!+1
if "!sel!"=="0" set sel=1
if "!sel!"=="!max!" set sel=!count!
goto adv_loop

:adv_sel_sel
if "!item%sel%!"=="Safe mode" (
set "%safe%=true"
set sel=%backupsel%
goto boot_sel
)
if "!item%sel%!"=="Recovery mode" (
set "%recovery%=true"
set sel=%backupsel%
goto boot_sel
)
if "!item%sel%!"=="Debug mode" (
set "%debug%=true"
set sel=%backupsel%
goto boot_sel
)
if "!item%sel%!"=="Start %name% normally" (
set sel=%backupsel%
goto boot_sel
)
if "!item%sel%!"=="Restart system" (
cls
echo Restarting...
start /b "" "%~xn0"
exit
)
if "!item%sel%!"=="Go back to boot options" (
set "sel=%default%"
goto boot_menu
)

:boot_sel
cls
set name=!e%sel%_name!
set internal=!e%sel%_internal!
set safe=!e%sel%_safe!
set recovery=!e%sel%_recovery!
set normal=!e%sel%_normal!
set debug=!e%sel%_debug!
if "!internal!"=="yes" goto internal_start
title Welcome to %name%!
if not "!internal!"=="yes" echo Loading %name% kernel...
if not "!internal!"=="yes" call :file_name_from_path startdir %normal% bootfile
if not "!internal!"=="yes" cd !startdir!
if not "!internal!"=="yes" !bootfile!
exit

:file_name_from_path
set "%~1=%~dp2"
set "%~3=%~nx2"
exit /b

:boot_menu_panic
cls
color 5f
echo.
echo It looks like the boot manager encountered a problem relating
echo to boot configuration or other data.
echo.
echo Error details: 'cannot find bg.exe in bin_os directory' (EID: 107)
echo.
echo Booting from internal device in 10 seconds...
echo.
ping localhost -n 10 >nul
goto internal_start

:writebsdeleter
@echo.dash off>specific_os\root\document\delete_bootscreen.cs
@echo.print Deleting existing bootscreen files...>>specific_os\root\document\delete_bootscreen.cs
@echo.system -start -delscreen>>specific_os\root\document\delete_bootscreen.cs
@echo.print Done>>specific_os\root\document\delete_bootscreen.cs
@echo.pause>>specific_os\root\document\delete_bootscreen.cs
@echo.dash on>>specific_os\root\document\delete_bootscreen.cs
goto :eof

:writeloginfixer
@echo.dash off>specific_os\root\document\login_fixer.cs
@echo.qreg fxusr=none>>specific_os\root\document\login_fixer.cs
@echo.qreg answer=1>>specific_os\root\document\login_fixer.cs
@echo.bgfg 0f>>specific_os\root\document\login_fixer.cs
@echo.println>>specific_os\root\document\login_fixer.cs
@echo.print Welcome to logon troubleshooter>>specific_os\root\document\login_fixer.cs
@echo.println>>specific_os\root\document\login_fixer.cs
@echo.print What problem are you facing right now?>>specific_os\root\document\login_fixer.cs
@echo.println>>specific_os\root\document\login_fixer.cs
@echo.print 1. User accounts don't show up>>specific_os\root\document\login_fixer.cs
@echo.print 2. Numbers are missing>>specific_os\root\document\login_fixer.cs
@echo.print 3. Numbers show, but accounts are missing>>specific_os\root\document\login_fixer.cs
@echo.print 4. None of the above>>specific_os\root\document\login_fixer.cs
@echo.println>>specific_os\root\document\login_fixer.cs
@echo.dash Pick a number and press ENTER:>>specific_os\root\document\login_fixer.cs
@echo.input answer>>specific_os\root\document\login_fixer.cs
@echo.switch 13 ^^!answer^^! 1 >>specific_os\root\document\login_fixer.cs
@echo.	println>>specific_os\root\document\login_fixer.cs
@echo.	print This is most likely caused by broken settings file>>specific_os\root\document\login_fixer.cs
@echo.	println>>specific_os\root\document\login_fixer.cs
@echo.	print You can try the following:>>specific_os\root\document\login_fixer.cs
@echo.	println>>specific_os\root\document\login_fixer.cs
@echo.	print  - Switch to classic logon screen and type the username there ^^(press C at the login screen^^)>>specific_os\root\document\login_fixer.cs
@echo.	print  - Reboot to recovery ^^(ESC to bring up the power menu and then press D^^) and perform system refresh>>specific_os\root\document\login_fixer.cs
@echo.	print  - Perform system refresh twice ^^(erases admin and guest data^^)>>specific_os\root\document\login_fixer.cs
@echo.	print  - Restore from the last backup ^^(in recovery^^)>>specific_os\root\document\login_fixer.cs
@echo.	print  - Delete any boot screen files ^^(press F11 at the login screen^^)>>specific_os\root\document\login_fixer.cs
@echo.	print  - As a last resort, wipe everything ^^(in recovery^^)>>specific_os\root\document\login_fixer.cs
@echo.	println>>specific_os\root\document\login_fixer.cs
@echo.	pause>>specific_os\root\document\login_fixer.cs
@echo.switch 22 ^^!answer^^! 2 >>specific_os\root\document\login_fixer.cs
@echo.	println>>specific_os\root\document\login_fixer.cs
@echo.	print This can be fixed with a simple command>>specific_os\root\document\login_fixer.cs
@echo.	print system -Llogon +fixuser>>specific_os\root\document\login_fixer.cs
@echo.	println>>specific_os\root\document\login_fixer.cs
@echo.	dash Would you like to run this command? ^^(Y/N^^)>>specific_os\root\document\login_fixer.cs
@echo.	input fxusr>>specific_os\root\document\login_fixer.cs
@echo.	switch 1 ^^!fxusr^^! Y>>specific_os\root\document\login_fixer.cs
@echo.		system -Llogon +fixuser>>specific_os\root\document\login_fixer.cs
@echo.	switch 1 ^^!fxusr^^! y>>specific_os\root\document\login_fixer.cs
@echo.		system -Llogon +fixuser>>specific_os\root\document\login_fixer.cs
@echo.	switch 5 ^^!fxusr^^! N>>specific_os\root\document\login_fixer.cs
@echo.		println>>specific_os\root\document\login_fixer.cs
@echo.		print We couldn't troubleshoot your problem. If problems continue, please contact the developers over at>>specific_os\root\document\login_fixer.cs
@echo.		print http://logos-technologies.blogspot.com/p/feedback.html>>specific_os\root\document\login_fixer.cs
@echo.		println>>specific_os\root\document\login_fixer.cs
@echo.		pause>>specific_os\root\document\login_fixer.cs
@echo.	switch 5 ^^!fxusr^^! n>>specific_os\root\document\login_fixer.cs
@echo.		println>>specific_os\root\document\login_fixer.cs
@echo.		print We couldn't troubleshoot your problem. If problems continue, please contact the developers over at>>specific_os\root\document\login_fixer.cs
@echo.		print http://logos-technologies.blogspot.com/p/feedback.html>>specific_os\root\document\login_fixer.cs
@echo.		println>>specific_os\root\document\login_fixer.cs
@echo.		pause>>specific_os\root\document\login_fixer.cs
@echo.switch 13 ^^!answer^^! 3 >>specific_os\root\document\login_fixer.cs
@echo.	println>>specific_os\root\document\login_fixer.cs
@echo.	print This is most likely caused by broken settings file>>specific_os\root\document\login_fixer.cs
@echo.	println>>specific_os\root\document\login_fixer.cs
@echo.	print You can try the following:>>specific_os\root\document\login_fixer.cs
@echo.	println>>specific_os\root\document\login_fixer.cs
@echo.	print  - Switch to classic logon screen and type the username there ^^(press C at the login screen^^)>>specific_os\root\document\login_fixer.cs
@echo.	print  - Reboot to recovery ^^(ESC to bring up the power menu and then press D^^) and perform system refresh>>specific_os\root\document\login_fixer.cs
@echo.	print  - Perform system refresh twice ^^(erases admin and guest data^^)>>specific_os\root\document\login_fixer.cs
@echo.	print  - Restore from the last backup ^^(in recovery^^)>>specific_os\root\document\login_fixer.cs
@echo.	print  - Delete any boot screen files ^^(press F11 at the login screen^^)>>specific_os\root\document\login_fixer.cs
@echo.	print  - As a last resort, wipe everything ^^(in recovery^^)>>specific_os\root\document\login_fixer.cs
@echo.	println>>specific_os\root\document\login_fixer.cs
@echo.	pause>>specific_os\root\document\login_fixer.cs
@echo.switch 5 ^^!answer^^! 4 >>specific_os\root\document\login_fixer.cs
@echo.	println>>specific_os\root\document\login_fixer.cs
@echo.	print We couldn't troubleshoot your problem. If problems continue, please contact the developers over at>>specific_os\root\document\login_fixer.cs
@echo.	print http://logos-technologies.blogspot.com/p/feedback.html>>specific_os\root\document\login_fixer.cs
@echo.	println>>specific_os\root\document\login_fixer.cs
@echo.	pause>>specific_os\root\document\login_fixer.cs
@echo.dash clear>>specific_os\root\document\login_fixer.cs
@echo.dash on>>specific_os\root\document\login_fixer.cs
goto :eof

:passit
set flashresult=goodtogo
set opasswd=true
set type=Package
set system=%0
set version=3.0
set edition=Standard
set OEM=none
exit /b

