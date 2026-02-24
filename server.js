const express = require('express');
const cors = require('cors');
const axios = require('axios');
const app = express();

// 1. 跨域配置（允许你的前端域名访问）
app.use(cors({
  origin: 'https://jackycltcp11-cloud.github.io', // 替换为你的前端域名
  methods: ['POST'],
  allowedHeaders: ['Content-Type']
}));

// 2. 解析JSON请求体
app.use(express.json({ limit: '10mb' })); // 放宽大小限制，适配图片Base64

// 3. 订单转发接口
app.post('/api/forward-order', async (req, res) => {
  try {
    // 打印订单日志（方便调试）
    console.log('收到订单：', req.body);

    // 转发到目标网站的订单接收接口（替换为目标网站的API地址）
    const targetApiUrl = 'https://www.maclazer.com/api/order/receive';
    const response = await axios.post(targetApiUrl, req.body, {
      // 目标网站接口的鉴权（如有）：如Token/密钥
      headers: {
        'Content-Type': 'application/json',
        // 'Authorization': 'Bearer 你的目标网站接口Token'
      }
    });

    // 响应前端：提交成功
    res.json({
      success: true,
      message: '订单已转发到目标网站',
      data: response.data
    });
  } catch (error) {
    // 错误处理
    console.error('订单转发失败：', error.message);
    res.status(500).json({
      success: false,
      error: error.message || '订单转发失败，请联系管理员'
    });
  }
});

// 4. 启动服务
const port = process.env.PORT || 3000;
app.listen(port, () => {
  console.log(`后端接口运行在端口：${port}`);
});
