#!/bin/sh
#
# webnotepad_backup.sh
#
# Script which allows you to backup webnotepad's files.
# It preserves one complete copy of webnotepad's files for every day in the week. So you have 7 backups from last 7 days.
#
# Script should be run from cron, e.g. every 1 day.
# * * */1 * * /home/user/public_html/webnotepad/webnotepad_backup.sh >/dev/null 2>&1

############
# Settings #
############

DIR="/home/user/public_html/webnotepad" # directory with this script

#############
# Main Part #
#############

rm -f $DIR/backup/backup-7/*.txt
mv $DIR/backup/backup-6/*.txt $DIR/backup/backup-7
mv $DIR/backup/backup-5/*.txt $DIR/backup/backup-6
mv $DIR/backup/backup-4/*.txt $DIR/backup/backup-5
mv $DIR/backup/backup-3/*.txt $DIR/backup/backup-4
mv $DIR/backup/backup-2/*.txt $DIR/backup/backup-3
mv $DIR/backup/backup-1/*.txt $DIR/backup/backup-2
cp $DIR/files/*.txt $DIR/backup/backup-1
