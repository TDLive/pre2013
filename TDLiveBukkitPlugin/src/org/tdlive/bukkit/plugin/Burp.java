package org.tdlive.bukkit.plugin;

import org.bukkit.Server;
import org.bukkit.Sound;
import org.bukkit.command.Command;
import org.bukkit.command.CommandExecutor;
import org.bukkit.command.CommandSender;
import org.bukkit.entity.Player;

public class Burp implements CommandExecutor {
	private Plugin plugin;
	private Server server;

	public Burp(Plugin plugin) {
		this.plugin = plugin;
	}
	
	@Override
	public boolean onCommand(CommandSender sender, Command cmd, String label, String[] args) {
		String playername=sender.getName();
		Player player=server.getPlayer(playername);
		player.playSound(player.getLocation(), Sound.BURP, 7, 1);
	    plugin.getLogger().info("Burp caused by " + playername);
	    sender.sendMessage("*belches* excuse me! Teehee.");
		return true;
	}
}
