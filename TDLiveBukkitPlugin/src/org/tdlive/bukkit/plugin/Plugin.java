package org.tdlive.bukkit.plugin;

import org.bukkit.plugin.java.JavaPlugin;
     
public final class Plugin extends JavaPlugin {
    
  	public void onEnable(){
   		getLogger().info("TDLive BukkitPlugin is being started, yay!");
   		getLogger().info("Initializing command: lol");
   		getCommand("lol").setExecutor(new HahaLOL(this));
   		getLogger().info("Initializing command: burp");
   		getCommand("burp").setExecutor(new Burp(this));
   		getLogger().info("Yay! TDLive BukkitPlugin has been started, done!");
   	}
    public void onDisable(){
    	getLogger().info("TDLive BukkitPlugin is being disabled, o noes!");
    	getLogger().info("TDLive BukkitPlugin has been disabled. ;.;");
    }
}
