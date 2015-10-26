package org.tdlive.bukkit.plugin;

import org.bukkit.command.Command;
import org.bukkit.command.CommandExecutor;
import org.bukkit.command.CommandSender;

public class HahaLOL implements CommandExecutor {
	private Plugin plugin;

	public HahaLOL(Plugin plugin) {
		this.plugin = plugin;
	}
	
	@Override
	public boolean onCommand(CommandSender sender, Command cmd, String label, String[] args) {
	    plugin.getLogger().info("Responding to a /lol: Haha, LOL!");
		sender.sendMessage("Haha, LOL!");
		return true;
	}

}
