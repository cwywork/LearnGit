/*===================GIT LEARN=================*/
１.安装Git  sudo apt-get install git
２.创建版本库　$ mkdir learngit　$ cd learngit　$ git init　　
	　　　　　　$ git add readme.txt　　$ git commit -m "wrote a readme file"

３．版本回退　$ git log --pretty=oneline（日志）$ git reset --hard HEAD^（上一次版本）
	　　　　　$ git reflog（查看回退版本的ＩＤ）　$ git reset --hard 3628164(回退ＩＤ版本)
４．工作区　暂存区(add)　分支区(commit)　的概念

５．删除文件　rm test.txt（删工作区）　 $git rm test.txt  $ git commit -m "remove test.txt"（删分支区）

６．连接码云　git remote add github git@github.com:wenyuwork/learnGit.git　　　　git remote -v（查看）

	git fetch origin master （取）  　git pull origin master（放服务器）
git init   
7.push前先将远程repository修改pull下来

$ git pull origin master

$ git push -u origin master

13.229.188.59

/*==================快捷操作＝＝＝＝＝＝＝＝＝＝＝*/
1.ctrl+W关闭当前标签页
２．ctrl+T新打开标签页
３．ctrl+shift+T新打开终端的标签页


/*===================MYSQL索引===============*/
１．ALTER TABLE table_name ADD INDEX index_name (column_list)
2.查询优化神器 - explain命令



/*=====================LAMP常用=================*/
1．locate php.ini 查找位置
2．service nginx stop
3. nginx -t 
/usr/local/nginx/conf/vhost


/*==================MYSQL语句=================*/
语句排查　left join 能引起行变多是因为右表符合左表条件的不止一条记录



