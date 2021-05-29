USE pinger;

CREATE TABLE `host` (
                        `id` int(11) NOT NULL,
                        `ip` varchar(15) NOT NULL DEFAULT '',
                        `packet_size` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `host` (`id`, `ip`, `packet_size`) VALUES
(1, '8.8.8.8', 32),
(2, '127.0.0.1', 32),
(3, '8.8.4.4', 32);

CREATE TABLE `session` (
                           `id` int(11) NOT NULL,
                           `user_id` int(11) NOT NULL DEFAULT '0',
                           `hash` varchar(32) NOT NULL DEFAULT '',
                           `disabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `user` (
                        `id` int(11) NOT NULL,
                        `username` varchar(250) NOT NULL,
                        `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'password');

ALTER TABLE `host`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `session`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `host`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `session`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;