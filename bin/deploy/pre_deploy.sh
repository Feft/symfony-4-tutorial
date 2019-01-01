# Remove symlink
if [ -d /var/www/micropost_old ]; then sudo rm -R /var/www/micropost_old; fi &&
sudo cp -R /var/www/micropost_current /var/www/micropost_old/ &&
sudo rm /var/www/micropost &&
sudo rm -R /var/www/micropost_current &&
# Create symlink to older version
sudo ln -s /var/www/micropost_old /var/www/micropost