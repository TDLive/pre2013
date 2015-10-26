#!/bin/bash
#TDLive LivePorted Installer for make
#(c)2011 TDLive. Licensed under the GNU GPL.

#Set the package name
pwd=$(pwd);
package="make";
cd "$LIVEPORTEDDIR/";
if [ -e "usr/bin/make" ]; then
echo "This package is already installed!";
exit;
fi
echo "P: Preparing to install $package...";
echo "[1 of 2] Preparing install...";
echo "[2 of 2] Preparing install...";
#We would check the PATH variable here but that would be too dangerous. If someone would like to suggest a way to do this safely, please do.
echo "[1 of 2] Downloading files...";
wget "https://github.com/TDLive/LivePorted/raw/master/binaries/make"
echo "[2 of 3] CHMOD-ing make...";
chmod +x make;
echo "[3 of 3] Applying changes...";
mv "make" "usr/bin/";
rm "$0";
echo "Completed.";
