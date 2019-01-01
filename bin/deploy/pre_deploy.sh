# Remove symlink
sudo bin/deploy/delete_micropost_old.sh &&
sudo cp -R /var/www/micropost_current /var/www/micropost_old/ &&
sudo rm /var/www/micropost &&
sudo rm -R /var/www/micropost_current &&
# Create symlink to older version
sudo ln -s /var/www/micropost_old /var/www/micropost