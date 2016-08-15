drop table if exists b_employee;
create table b_employee(
    id                  int unsigned not null auto_increment,

    account             varchar(32) not null default '',
    passwd              char(32) not null default '',

    name                varchar(255) not null default '',
    phone               char(11) not null default '',
    state               tinyint not null default 0,                 # 用户状态

    ctime               int not null default 0,                     # 创建时间

    primary key (`id`),
    index idx_account(`account`),
    index idx_phone(`phone`)
)engine=InnoDB default charset=utf8;
insert into b_employee(account,passwd,name,phone,state,ctime)values('admin',md5('4stringadmin'),'管理员','13800138000',1,unix_timestamp());

drop table if exists event;
create table event (
    id                  int unsigned not null auto_increment,

    topic               varchar(255) not null default '',           # 主题
    image_urls          varchar(2048) not null default '',          # 商品轮播图片(json格式)
    sort                int not null default 0,                     # 排序
    state               tinyint not null default 0,                 # 状态

    ctime               int not null default 0,                     # 创建时间
    mtime               int not null default 0,                     # 修改时间

    primary key (`id`)
)engine=InnoDB default charset=utf8;

drop table if exists video;
create table video (
    id                  int unsigned not null auto_increment,

    remark              varchar(255) not null default '',           # 备注
    image_url           varchar(2048) not null default '',          # 
    video_url           varchar(2048) not null default '',          # 
    sort                int not null default 0,                     # 排序
    state               tinyint not null default 0,                 # 状态

    ctime               int not null default 0,                     # 创建时间
    mtime               int not null default 0,                     # 修改时间

    primary key (`id`)
)engine=InnoDB default charset=utf8;
