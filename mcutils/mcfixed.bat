@echo off
echo TDLive mcutils 1.0.0
echo Utilities to make the life of a Minecraft server admin easier
echo Greatly inspired by http://github.com/spikegrobstein/mcwrapper
echo.
echo (c)2012 TDLive.org and Contributors. Some rights reserved;
echo Licensed under the Creative Commons BY-NC-SA license:
echo See http://creativecommons.org/licenses/by-nc-sa/3.0.
echo.
C:
if "%1"=="craftbukkit" (
	if "%2"=="get" (
		echo Using GNU wget to get http://cbukk.it/craftbukkit.jar...
		C:\wget\bin\wget --version > NUL
		if not "%ERRORLEVEL%"==0 (
			echo It seems that you don't have wget installed, or it's not in your PATH. Please
			echo install GNU wget to download Craftbukkit.
			goto end
		)
		if not exist "C:\bukkit" (
			echo Creating Craftbukkit directories...
			mkdir C:\bukkit
		)
		cd C:\bukkit
		C:\wget\bin\wget http://cbukk.it/craftbukkit.jar -O craftbukkit.jar
		echo Done! Run "%0 craftbukkit start" to start the server.
		goto end
	)
	if "%2"=="start" (
		echo Starting Craftbukkit, please wait...
		if not exist "C:\bukkit" (
			echo According to Windows, Craftbukkit is not installed on this computer. Please
			echo run "%0 craftbukkit get" with wget installed to get Craftbukkit.
			goto end
		)
		cd C:\bukkit
		echo. > command_input
		echo ...done! Please kill the server with "%0 craftbukkit stop" to stop the server.
		java -Xmx1024M -Xms1024M -jar craftbukkit.jar --nojline > NUL < command_input
	)
	if "%2"=="stop" (
		if not exist "C:\bukkit" (
			echo According to Windows, Craftbukkit is not installed on this computer. Please
			echo run "%0 craftbukkit get" with wget installed to get Craftbukkit.
			goto end
		)
		cd C:\bukkit
		echo Stopping Craftbukkit, please wait...
		echo stop > command_input
		echo ...done!
	)
	if "%2"=="cinput" (
		if not exist "C:\bukkit" (
			echo According to Windows, Craftbukkit is not installed on this computer. Please
			echo run "%0 craftbukkit get" with wget installed to get Craftbukkit.
			goto end
		)
		cd C:\bukkit
		echo Running command %3 %4 %5 %6 %7 %8 %9...
		echo %3 %4 %5 %6 %7 %8 %9 > command_input
		echo ...done.
		goto end
	)
	if "%2"=="open" (
		echo Opening C:\bukkit...
		explorer C:\bukkit
		echo ...done!
		goto end
	)
	if "%2"=="installplugins" (
		cd C:\bukkit
		echo Preparing to download %3...
		cd plugins
		C:\wget\bin\wget %3 > NUL
		echo ...done!
	)
)
if "%1"=="vanilla" (
	if "%2"=="get" (
		echo Using GNU wget to get https://s3.amazonaws.com/MinecraftDownload/launcher/minecraft_server.jar...
		C:\wget\bin\wget --version > NUL
		if not "%ERRORLEVEL%"==0 (
			echo It seems that you don't have wget installed, or it's not in your PATH. Please
			echo install GNU wget to download Vanilla.
			goto end
		)
		if not exist "C:\vanilla" (
			echo Creating Vanilla directories...
			mkdir C:\bukkit
		)
		cd C:\vanilla
		C:\wget\bin\wget https://s3.amazonaws.com/MinecraftDownload/launcher/minecraft_server.jar -O minecraft_server.jar
		echo Done! Run "%0 vanilla start" to start the server.
		goto end
	)
	if "%2"=="start" (
		echo Starting Vanilla, please wait...
		if not exist "C:\vanilla" (
			echo According to Windows, Vanilla is not installed on this computer. Please
			echo run "%0 vanilla get" with wget installed to get Vanilla.
			goto end
		)
		cd C:\vanilla
		echo ...done! Please kill the server with "%0 vanilla stop" to stop the server.
		java -Xmx1024M -Xms1024M -jar craftbukkit.jar --nojline > NUL < command_input
	)
	if "%2"=="stop" (
		if not exist "C:\vanilla" (
			echo According to Windows, Vanilla is not installed on this computer. Please
			echo run "%0 vanilla get" with wget installed to get Vanilla.
			goto end
		)
		cd C:\vanilla
		echo Stopping Vanilla, please wait...
		echo stop > command_input
		echo ...done!
	)
	if "%2"=="cinput" (
		echo. > command_input
		cd C:\vanilla
		echo Running command %3 %4 %5 %6 %7 %8 %9...
		echo %3 %4 %5 %6 %7 %8 %9 > command_input
		echo ...done.
		goto end
	)
	if "%2"=="open" (
		echo Opening C:\vanilla...
		explorer C:\vanilla
		echo ...done!
		goto end
	)
	if "%2"=="installplugins" (
		echo Sorry, this command is only available with Craftbukkit.
	)
)
:end
if exist command_input del command_input