### SEARCH FILE IN MAC:
```bash
find ~ -iname \*resume\*
find / -iname \*NetBeans\*
```
### REMOVE FILE OR FOLDER

```bash
rm -rf file|folder (path to file or folder)
```

example:
```bash
rm org.netbeans.ide.*
```

### edit host file, type command bellow and hit enter, then type password, update and Ctrl+O to save
```bash
sudo nano /private/etc/hosts
```

### Generate ssh key in mac
<a href="https://drupal.org/node/1070130" target="_blank">Detail</a>

```bash
$ pbcopy < ~/.ssh/id_rsa.pub
$ pbpaste > ~/clipboard.text
```
### REMOVE Start up Programes

`/Library/LaunchAgents/com.adobe.AdobeCreativeCloud.plist`
### Unload It
`launchctl unload -w /Library/LaunchAgents/com.adobe.AdobeCreativeCloud.plist`
### To Turn It back on

`launchctl load -w /Library/LaunchAgents/com.adobe.AdobeCreativeCloud.plist`

### MAMP PRO MYSQL DATABASE FOLDER
`/Library/Application Support/appsolute/MAMP PRO/db/mysql56/`
